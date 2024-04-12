
// Récupération des éléments du formulaire
const form =  document.querySelector('form'); // Sélectionne le formulaire entier
const nomInput = document.querySelector('#InputNom'); // Sélectionne le champ de saisie du nom
const prenomInput = document.querySelector('#InputPrenom'); // Sélectionne le champ de saisie du prénom
const emailInput = document.querySelector('input[type=email]'); // Sélectionne le champ de saisie de l'email
const sujetInput = document.querySelector('#InputSujet'); // Sélectionne le champ de saisie du sujet
const msgInput = document.querySelector('#InputMessage'); // Sélectionne le champ de saisie du message

// Définition des paramètres de validation pour chaque champ du formulaire

// Expression régulière pour valider le nom et le prénom
// Autorise les lettres, les tirets, les traits de soulignement et les espaces
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

// Cette fonction vérifie si l'adresse email est valide lors de la saisie et applique les classes CSS en conséquence
emailInput.addEventListener('input', (e)=>{
    console.log(e.target.value)
    if(EmailRegex.test(emailInput.value)){
        emailInput.classList.add('is-valid'); // Ajoute la classe 'is-valid' pour un email valide
        emailInput.classList.remove('is-invalid'); // Supprime la classe 'is-invalid' pour un email valide
    } else{
        emailInput.classList.add('is-invalid'); // Ajoute la classe 'is-invalid' pour un email invalide
        emailInput.classList.remove('is-valid'); // Supprime la classe 'is-valid' pour un email invalide
    }
}) 

// Cette fonction ajoute ou supprime les classes CSS is-valid et is-invalid en fonction du résultat de la validation regex
function addClass(element,regex,value,valid) {
    if (regex.test(value)) {
        element.classList.add('is-valid') // Ajoute la classe 'is-valid' si la valeur est valide
        element.classList.remove('is-invalid')  // Supprime la classe 'is-invalid' si la valeur est valide
        valid = true
    } else {
        element.classList.remove('is-valid') // Supprime la classe 'is-valid' si la valeur est invalide
        element.classList.add('is-invalid') // Ajoute la classe 'is-invalid' si la valeur est invalide
        valid = false
    }
}

// Les événements d'entrée pour chaque champ du formulaire déclenchent la fonction addClass pour la validation
nomInput.addEventListener('input', e => addClass(nomInput,NameRegex, e.target.value,nomValid));
prenomInput.addEventListener('input', e => addClass(prenomInput,NameRegex, e.target.value,prenomValid));
sujetInput.addEventListener('input', e=>addClass(sujetInput,SujetRegex, e.target.value,sujetValid));
emailInput.addEventListener('input', e=>addClass(emailInput,EmailRegex, e.target.value,emailValid));
msgInput.addEventListener('input', e=>addClass(msgInput,MessageRegex, e.target.value,msgValid));

// Cette fonction valide chaque champ du formulaire en fonction du regex fourni et applique les classes CSS en conséquence
function validateInput(input, regex) {
    if (regex.test(input.value)) {
        input.classList.add('is-valid'); // Ajoute la classe 'is-valid' si la valeur est valide
        input.classList.remove('is-invalid'); // Supprime la classe 'is-invalid' si la valeur est valide
        return true;
    } else {
        input.classList.remove('is-valid'); // Supprime la classe 'is-valid' si la valeur est invalide
        input.classList.add('is-invalid'); // Ajoute la classe 'is-invalid' si la valeur est invalide
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
    const submitButton = document.getElementById('submitButton');
    const nomInput = document.getElementById('InputNom');
    const prenomInput = document.getElementById('InputPrenom');
    const emailInput = document.getElementById('inputEmail');
    const sujetInput = document.getElementById('InputSujet');
    const msgInput = document.getElementById('InputMessage');

    const isNomValid = /^[a-zA-Z][a-zA-Z-_ ]{3,23}$/.test(nomInput.value);
    const isPrenomValid = /^[a-zA-Z][a-zA-Z-_ ]{3,23}$/.test(prenomInput.value);
    const isEmailValid = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailInput.value);
    const isSujetValid = /^[^<>{}$]{3,200}$/.test(sujetInput.value);
    const isMessageValid = /^[^<>{}$]{24,}$/.test(msgInput.value);

    if (isNomValid && isPrenomValid && isEmailValid && isSujetValid && isMessageValid) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
}

// Écouter les événements de saisie dans les champs du formulaire pour activer ou désactiver le bouton Envoyer
document.getElementById('InputNom').addEventListener('input', toggleSubmitButton);
document.getElementById('InputPrenom').addEventListener('input', toggleSubmitButton);
document.getElementById('inputEmail').addEventListener('input', toggleSubmitButton);
document.getElementById('InputSujet').addEventListener('input', toggleSubmitButton);
document.getElementById('InputMessage').addEventListener('input', toggleSubmitButton);

