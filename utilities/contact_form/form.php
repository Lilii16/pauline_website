

<div class="m-5 p-2"></div>
<div class="w-100 mt-5 bg-red vh-100 radius p-4 relative">
    <form class="d-flex align-items-center justify-content-center inner-radius bg-light-50-beige mt-auto mx-auto absolute col-md-8"  method="POST" action="/utilities/contact_form/send_email.php" id="myForm">
        <!-- contenaire formulaire -->
        <div class="container mt-5 p-md-5">
            <!-- titres-->
            <div class="text-center">
                <h3 class="text-red fx-bold">Formulaire de contact</h3>
            </div>

            <!-- debut inputs -->

            <div class="container col-md-10">
                <!-- nom et prenom -->
                <div class="form-group text-start row  row-cols-md-2 row-cols-1">
                    <div class="form-group col mb-4">
                        <input type="text" class="form-control shadow rounded-4 bg-beige" id="InputNom"name="name" placeholder="Nom">
                    </div>
                    <div class="form-group col mb-4">
                        <input type="text"   id="InputPrenom" name="firstName" class="form-control shadow rounded-4 bg-beige"
                        placeholder="Prénom">
                    </div>
                </div>
                <!-- reste des infos -->
                <div class="form-group d-flex flex-column justify-content-center mb-4">

                <!-- div mail -->
                    <div class="form-group mb-4">
                        <input type="email" name="email" class="form-control shadow rounded-5 bg-beige" id="inputEmail" placeholder="Votre adresse e-mail">
                    </div>
                    <!-- div selecteur -->
                    <div class="form-group mb-4">
                        <!-- selecteur de sujet -->
                        <label for="inputChoice">Votre choix</label>
                        <select id="inputChoice" class="selectedOption form-control shadow rounded-5 bg-beige" name="selectedOption">
                            <option selected>Aide juridique (avocatie)</option>
                            <option>Formations</option>
                        </select>
                    </div>
                    <!-- div sujet -->
                    <div class="form-group mb-4">
                        <input type="text" class="form-control rounded-5 bg-beige" id="InputSujet" name="sujet" placeholder="Sujet">
                    </div>
                    <!-- Champ pour le message -->
                    <div class="form-group mb-4">
                        <textarea class="form-control shadow rounded-md-5 rounded-4 bg-beige" id="InputMessage" name="message" rows="5" maxlength="500" placeholder="Votre message" required></textarea>

                        <!-- Information sur la limite de caractères -->
                    </div>

                    <!-- check pour informations correctes -->
                    <div class="form-group mb-2">
                        <div class="form-check">
                            <input class="form-check-input bg-beige" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Toutes mes informations sont correctes.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                  <!-- ce bouton est désactivé au chargement de la page car pour envoyer le formulaire les informations doivent etre correctes  -->
                <button type="submit" id="submitButton" class="btn text-center bg-beige text-red  col-md-4  col-6 rounded-pill border-3 mx-auto" disabled>Envoyer</button>

                </div>
            </div>
        </div>
    </form>
</div>
<!-- https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/securiser-valider-formulaire/ -->

<script>
// Récupération des éléments du formulaire
const form = document.querySelector('form');

// je vais utiliser un object qui récupére les elements du formulaire pour éviter de le répeter car j'ai plusieurs fontions qui les utilisent
const inputs = {
  // Sélectionne le champ de saisie du nom
  nom: document.getElementById('InputNom'), 
  // Sélectionne le champ de saisie du prénom
  prenom: document.getElementById('InputPrenom'), 
 // Sélectionne le champ de saisie de l'email
  email: document.querySelector('input[type=email]'),
// Sélectionne le champ de saisie du sujet
  sujet: document.getElementById('InputSujet'), 
 // Sélectionne le champ de saisie du message
  message: document.getElementById('InputMessage'),
};

// Sélectionne le bouton "Envoyer", il va me servir à bloquer l'envoie si les infos sont pas bonnes
const submitButton = document.getElementById('submitButton'); 

// object Expressions régulières de validation idem reutilisé plusieurs fois
const regex = {

// Expression régulière pour valider le nom et le prénom
// Autorise les lettres, les tirets, les traits de soulignement et les espaces (car certaines personnes comme moi ont plusieurs noms et prenoms)
// Doit commencer par une lettre
// Longueur de 3 à 23 caractères
  nomPrenom: /^[a-zA-Z][a-zA-Z-_ ]{3,23}$/, 
// Expression régulière pour valider l'email
// Doit avoir un format d'email valide
  email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
  // Expression régulière pour valider le sujet
// Ne doit pas contenir certains caractères spéciaux (<, >, {, }, $)
// Longueur de 3 à 200 caractères 
  sujetMessage: /^[^<>{}$]{3,200}$/, 
// Expression régulière pour valider le message
// Ne doit pas contenir certains caractères spéciaux (<, >, {, }, $)
// Longueur minimale de 24 caractères
  message: /^[^<>{}$]{24,}$/, 
};

// Fonction pour valider et mettre à jour les classes CSS
function validateAndUpdate(element, regex) {
  // Vérifie si la valeur de l'élément passe la validation regex
  const isValid = regex.test(element.value); 
  // Ajoute ou supprime les classes CSS 'is-valid' ou 'is-invalid' en fonction du résultat de la validation
  element.classList.toggle('is-valid', isValid);
  element.classList.toggle('is-invalid', !isValid);
 // Renvoie true si la valeur est valide, sinon false
  return isValid;
}

// Écouter les événements d'entrée/saisie dans les champs du formulaire pour la validation
Object.values(inputs).forEach(input =>
  input.addEventListener('input', () => {
    const isValid = validateAndUpdate(input, regex[input.id === 'InputEmail' ? 'email' : 'nomPrenom']);
    // Si l'input est celui de l'email, déclenche la vérification du formulaire complet
    if (input.id === 'InputEmail') toggleSubmitButton(); 
    // Sinon, déclenche la vérification du champ individuel
    else toggleSubmitButton(isValid); 
  })
);

// Fonction pour activer ou désactiver le bouton Envoyer
function toggleSubmitButton(isFormValid) {
  // Si la validité du formulaire n'est pas fournie, vérifie tous les champs
  if (isFormValid === undefined) {
    // Vérifie si tous les champs du formulaire sont valides en utilisant validateAndUpdate pour chacun
    isFormValid = Object.values(inputs).every(input => validateAndUpdate(input, regex[input.id === 'InputEmail' ? 'email' : 'nomPrenom']));
  }
  // Active ou désactive le bouton Envoyer en fonction de la validité du formulaire
  submitButton.disabled = !isFormValid;
}

</script>