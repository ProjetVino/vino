
function validNumberInput(input) {
    // Remplace toutes les lettres et caractères spéciaux par une chaîne vide
    input.value = input.value.replace(/[^0-9]/g, 1);
}

function validateAndCorrect(input) {
    // Vérifie si la saisie est vide ou non numérique
    if (input.value === "" || isNaN(input.value) || input.value == 0 || input.value == "0") {
        input.value = "1"; // Réinitialise à 1 si incorrect
    }
}