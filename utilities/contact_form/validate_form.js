// Récupération des éléments du formulaire
const form =  document.querySelector('form'); 
// Sélectionne le champ de saisie du nom, prenom, email, sujet,message
const nomInput = document.querySelector('#InputNom'); 
const prenomInput = document.querySelector('#InputPrenom'); 
const emailInput = document.querySelector('input[type=email]');
const sujetInput = document.querySelector('#InputSujet'); 
const msgInput = document.querySelector('#InputMessage'); 

// Définition des paramètres de validation pour chaque champ du formulaire

// Expression régulière pour valider le nom et le prénom
// Autorise les lettres, les tirets, les traits de soulignement et les espaces (car plusieurs prenoms ou noms possible)
// Doit commencer par une lettre
// Longueur de 3 à 23 caractères
const NameRegex = /^[a-zA-Z][a-zA-Z-_ ]{3,23}$/;

// Expression régulière pour valider l'email
// Doit avoir un format d'email valide
const EmailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

// Expression régulière pour valider le sujet
// Ne doit pas contenir certains caractères spéciaux (<, >, {, }, $)
// Longueur de 3 à 200 caractères
const SujetRegex = /^[^<>{}$]{3,200}$/;

// Expression régulière pour valider le message
// Ne doit pas contenir certains caractères spéciaux (<, >, {, }, $)
// Longueur minimale de 24 caractères
const MessageRegex = /^[^<>{}$]{24,}$/;



// Cette fonction valide chaque champ du formulaire en fonction du regex fourni et applique les classes CSS
function validateInput(input, regex) {
    if (regex.test(input.value)) {
        input.classList.add('is-valid'); 
        input.classList.remove('is-invalid'); 
        return true;
    } else {
        input.classList.remove('is-valid');
        input.classList.add('is-invalid'); 
        return false;
    }
}

// Les événements d'entrée pour chaque champ du formulaire déclenchent la fonction validateInput pour la validation
nomInput.addEventListener('input', () => validateInput(nomInput, NameRegex));
prenomInput.addEventListener('input', () => validateInput(prenomInput, NameRegex));
sujetInput.addEventListener('input', () => validateInput(sujetInput, SujetRegex));
emailInput.addEventListener('input', () => validateInput(emailInput, EmailRegex));
msgInput.addEventListener('input', () => validateInput(msgInput, MessageRegex));


// Fonction pour activer ou désactiver le bouton Envoyer en fonction de la validation du formulaire
function toggleSubmitButton() {
    // recuperer bouton
    const submitButton = document.getElementById('submitButton');
    
// verifier la validation de chaque input
const isNomValid = validateInput(nomInput, NameRegex);
const isPrenomValid = validateInput(prenomInput, NameRegex);
const isEmailValid = validateInput(emailInput, EmailRegex);
const isSujetValid = validateInput(sujetInput, SujetRegex);
const isMessageValid = validateInput(msgInput, MessageRegex);


// verifier que toutes les conditions sont valides
    if (isNomValid && isPrenomValid && isEmailValid && isSujetValid && isMessageValid) {
        submitButton.disabled = false;
    } else {
        // utiliser disabled pour desactiver le bouton submit
        submitButton.disabled = true;
    }
}

// Écouter les événements de saisie dans les champs du formulaire pour activer ou désactiver le bouton Envoyer
document.getElementById('InputNom').addEventListener('input', toggleSubmitButton);
document.getElementById('InputPrenom').addEventListener('input', toggleSubmitButton);
document.getElementById('inputEmail').addEventListener('input', toggleSubmitButton);
document.getElementById('InputSujet').addEventListener('input', toggleSubmitButton);
document.getElementById('InputMessage').addEventListener('input', toggleSubmitButton);

