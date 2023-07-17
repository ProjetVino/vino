<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DomCrawler\Crawler;

class SAQ
{
    const DUPLICATION = 'duplication';
    const ERREURDB = 'erreurdb';
    const INSERE = 'Nouvelle bouteille insérée';
    

    private $stmt;
    private $totalBouteilles;

    public function __construct()
    {
        $this->stmt = DB::connection()->getPdo()->prepare("INSERT INTO bouteilles(nom, type_id, image, code_saq, pays, description, prix_saq, url_saq, url_img, format) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $this->totalBouteilles = 0;
    }

    public function getProduits($nombre = 24, $page = 1)
    {
        /* $client = new Client(); */
        $client = new Client([
                'verify' => storage_path('certificats/cacert.pem'),
            ]);

        try {
            $url = "https://www.saq.com/fr/produits/vin?p=".$page."&product_list_limit=".$nombre."&product_list_order=name_asc";
            $response = $client->get($url);
            $webpage = $response->getBody()->getContents();
        } catch (RequestException $e) {
            // Gestion de l'erreur de requête...
            echo $e->getMessage();
        }        

        // Utilisez un analyseur HTML, par exemple, Symfony DOM Crawler, pour extraire les informations nécessaires du HTML
        $crawler = new Crawler($webpage);
        $elements = $crawler->filter('li.product-item');

        $i = 0;
        $elements->each(function ($node) use (&$i) {
            $info = $this->recupereInfo($node);

            echo "<p>".$info->nom;
            $retour = $this->ajouteProduit($info);
            echo "<br>Code de retour : " . $retour->raison . "<br>";
            if ($retour->succes == false) {
                echo "<pre>";
                var_dump($info);
                echo "</pre>";
                echo "<br>";
            } else {
                $i++;
                 $this->totalBouteilles = $i;
            }
            echo "</p>";
        });

        return $this->totalBouteilles;
    }

    private function recupereInfo($node)
    {
        $info = new \stdClass();

        
        // Récupérer l'URL d'origine de l'image
        $originalUrl = $node->filter('img.product-image-photo')->attr('src');

        // Extraire la première partie de l'URL avant le "?"
        $baseUrl = strtok($originalUrl, '?');

        // Construire la nouvelle URL avec la chaîne de requête
        $newUrl = $baseUrl . '?width=367&height=550&canvas=367,550&quality=80&fit=bounds';

        // Mettre à jour la valeur de $info->img avec la nouvelle URL
        $info->BigImg = $newUrl;




        $info->img = $node->filter('img.product-image-photo')->attr('src');
        $a_titre = $node->filter('a')->eq(1);
        $info->url = $a_titre->attr('href');
        $nom = $a_titre->text();
        $info->nom = $this->nettoyerEspace(trim($nom));

        // Type, format et pays
        $descNode = $node->filter('strong.product-item-identity-format');
        $info->desc = new \stdClass();
        $info->desc->texte = $this->nettoyerEspace($descNode->text());
        $aDesc = explode("|", $info->desc->texte);
        // tableau associatif pour faire la conversion du type de bouteille dans la base de données
        $type_bouteilles = [
            "Vin blanc" => 1,
            "Vin rouge" => 2,
            "Vin rosé" => 3
        ];
        if (count($aDesc) == 3) {
            $info->desc->type_id = $type_bouteilles[trim($aDesc[0])]; 
            $info->desc->format = trim($aDesc[1]);
            $info->desc->pays = trim($aDesc[2]);
        }

        // Code SAQ
        $saqCodeNode = $node->filter('div.saq-code');
        if (preg_match("/\d+/", $saqCodeNode->text(), $aRes)) {
            $info->desc->code_SAQ = trim($aRes[0]);
        }

        // Prix SAQ
        $prixSAQNode = $node->filter('span.price');
        $info->desc->prix_SAQ = floatval(str_replace(',', '.', trim(str_replace('$', '', $prixSAQNode->text()))));

        return $info;
    }

    private function ajouteProduit($info)
    {
        try {
            // Vérifier s'il y a une duplication
            $stmt = DB::table('bouteilles')->where('code_saq', $info->desc->code_SAQ)->first();
            if ($stmt) {
                return (object) ['succes' => false, 'raison' => self::DUPLICATION];
            }

            // Insérer le nouveau produit dans la base de données
            $resultat = $this->stmt->execute([
                $info->nom,
                $info->desc->type_id,
                $info->img,
                $info->desc->code_SAQ,
                $info->desc->pays,
                $info->desc->texte,
                $info->desc->prix_SAQ,
                $info->url,
                $info->BigImg,
                $info->desc->format,
            ]);

            if ($resultat) {
                return (object) ['succes' => true, 'raison' => self::INSERE];
            } else {
                return (object) ['succes' => false, 'raison' => self::ERREURDB];
            }
        } catch (\Exception $e) {
            return (object) ['succes' => false, 'raison' => $e->getMessage()];
        }
    }

    private function nettoyerEspace($str)
    {
        return preg_replace('/\s+/', ' ', $str);
    }
}
