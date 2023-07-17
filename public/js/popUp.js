
function ajouterAuCellier(event) {
    let idBouteille = event.currentTarget.getAttribute("data-id");
    afficherPopup();

    let ajouterButton = document.getElementById("popup-ajouter");
    ajouterButton.onclick = function () {
        envoyerFormulaire(idBouteille);
    };
}

function envoyerFormulaire(idBouteille) {
    let quantiteInput = document.getElementById("quantite");
    let cellierInput = document.getElementById("cellier");

    fetch("/ajouter-au-cellier", {
        method: "POST",
        headers: {

            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            
            quantite : quantiteInput.value,
            cellier_id : cellierInput.value,
            bouteille_id : idBouteille,
            vue_source : "index"
        }),
    })
        .then((response) => {
            if (response.ok) {
                console.log(response.json())
            } else {
                console.log(response)
            }
        })
        .catch((error) => {
            // Faire quelque chose en cas d'erreur
        });

    /* cacherPopup(); */
}


// JavaScript pour afficher/cacher la popup
function afficherPopup() {
    let popup = document.getElementById("popup");
    popup.style.display = "block";
}

function cacherPopup() {
    let popup = document.getElementById("popup");
    popup.style.display = "none";
}
