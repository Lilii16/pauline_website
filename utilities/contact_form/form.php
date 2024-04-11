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
                        <input type="text" class="form-control shadow rounded-4 bg-beige" id="inputLastName"name="name" placeholder="Nom">
                    </div>
                    <div class="form-group col mb-4">
                        <input type="text"   id="first-name" name="firstName" class="form-control shadow rounded-4 bg-beige"
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
                        <input type="text" class="form-control rounded-5 bg-beige" id="sujet" name="sujet" placeholder="Sujet">
                    </div>
                    <!-- Champ pour le message -->
                    <div class="form-group mb-4">
                        <textarea class="form-control shadow rounded-md-5 rounded-4 bg-beige" id="message" name="message" rows="5" maxlength="500" placeholder="Votre message" required></textarea>

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
                    <button type="submit" class="btn text-center bg-beige text-red  col-md-4  col-6 rounded-pill border-3 mx-auto">Envoyer</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/securiser-valider-formulaire/ -->
<script>
    function validateForm(event) {
    var name = document.getElementById('inputLastName').value;
    var firstName = document.getElementById('first-name').value;
    var email = document.getElementById('inputEmail').value;
    // Ajoutez des validations pour d'autres champs ici...

    var nameRegex = /^[a-zA-ZÀ-ÿ\s\-]+$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!nameRegex.test(name)) {
        alert("Nom invalide");
        event.preventDefault();
        return false;
    }

    if (!nameRegex.test(firstName)) {
        alert("Prénom invalide");
        event.preventDefault();
        return false;
    }

    if (!emailRegex.test(email)) {
        alert("Adresse e-mail invalide");
        event.preventDefault();
        return false;
    }

    // Autres validations pour les autres champs...

    // Si toutes les validations réussissent, le formulaire sera soumis normalement
}

document.getElementById('myForm').addEventListener('submit', validateForm);

</script>