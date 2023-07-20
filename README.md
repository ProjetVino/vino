

## tester importation des données depuis le site de la SAQ

Marche à suivre
- attention pour la configuration Db dans le fichier .env (pour Mac et windows)
- créer une base de données appelée "vino"
- faire : php artisan migrate:refresh --seed (Pour exécuter la migration et seeder pour le Role et le Type)
- lancer l'application php artisan serve
- faire votre choix dans le formulaire (nbPages et nbBouteilles).
- vérifier la base de données .
- version php utilisé 8.0.0.
- Bibliotheque utilisé pour l'importation des donnés de la SAQ 
    + Symfony\Component\DomCrawler\Crawler v 5.0

- ajout du framework VueJS, mais à date c'est en pause 
    pour tester "http://127.0.0.1:8000/test"

- LIEN WEBDEV : https://e2296101.webdev.cmaisonneuve.qc.ca/vino/

- test pour maitriser git
- test pour github readme
- sdfsdfsdfdfdsf

- Site de bouteilles: TheVine


