
function ajouterAuCellier(event) {
    debugger;
    let idBouteille = event.currentTarget.getAttribute("data-id");
    afficherPopup();

    let ajouterButton = document.getElementById("popup-ajouter");
    ajouterButton.onclick = function () {
        envoyerFormulaire(idBouteille);
    };
}

function envoyerFormulaire(idBouteille) {
    debugger;
    let quantiteInput = document.getElementById("quantite");
    let cellierInput = document.getElementById("cellier");

    let formData = new FormData();
    formData.append("quantite", quantiteInput.value);
    formData.append("cellier_id", cellierInput.value);
    formData.append("bouteille_id", idBouteille);
    formData.append("source", "index");

    fetch("/ajouter-au-cellier", {
        method: "POST",
        headers: {
           
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: formData,
    })
        .then((response) => {
            if (response.ok) {
                alert("ok");
            } else {
                alert("probleme");
                console.log(response);
            }
        })
        .catch((error) => {
            // Faire quelque chose en cas d'erreur
        });

    cacherPopup();
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
