
function ajouterAuCellier(event) {
    let idBouteille = event.currentTarget.getAttribute("data-id");
    afficherPopup();

    let ajouterButton = document.getElementById("popup-ajouter");
    ajouterButton.onclick = function () {
        envoyerFormulaire(idBouteille);
    };
}

function envoyerFormulaire(idBouteille) {
    const quantiteInput = document.getElementById("quantite");
    const cellierInput = document.getElementById("cellier");
    const messageContainer = document.getElementById("message-container");

     if (cellierInput.value === "") {
        messageContainer.innerHTML = '<div class="alert alert-danger">Sélectionner un cellier</div>';
        timerMessage(messageContainer);
        return; // Arrête l'exécution de la fonction
    }

    fetch("/ajouter-au-cellier", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            quantite: quantiteInput.value,
            cellier_id: cellierInput.value,
            bouteille_id: idBouteille,
            vue_source: "index",
        }),
    })
        .then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                console.log(response);
                throw new Error("problème technique");
            }
        })
        .then((data) => {
            const message = data.message; // Accède à la variable envoyée par le serveur
            messageContainer.innerHTML =
                '<div class="alert alert-success">' + message + "</div>"; // Affiche le message dans le conteneur
        })
        .catch((error) => {
            messageContainer.innerHTML =
                '<div class="alert alert-danger">' + error.message + "</div>";
            console.error(error);
        });

           timerMessage(messageContainer);

    /* cacherPopup(); */
}


// JavaScript pour afficher/cacher la popup
function afficherPopup() {
    const popup = document.getElementById("popup");
    popup.style.display = "block";
}

function cacherPopup() {
    const quantiteInput = document.getElementById("quantite");
    const cellierInput = document.getElementById("cellier");
    const messageContainer = document.getElementById("message-container");
    const popup = document.getElementById("popup");
    popup.style.display = "none";

    quantiteInput.value = 1;
    cellierInput.value = "";
    messageContainer.innerHTML = "" ;


}

function timerMessage(messageContainer) {
    // Supprimer le message après 3 secondes
    setTimeout(function () {
        messageContainer.innerHTML = "";
    }, 4000);
}
