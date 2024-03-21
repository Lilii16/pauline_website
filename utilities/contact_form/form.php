<?php
require_once dirname(__DIR__, 2) . '/utilities/composant_general/header.php';
require_once dirname(__DIR__, 2) . '/utilities/navigation/navbar.php';
?>

<div class="m-4">
<form>
<div class="col-md-12 mx-auto my-4"> <!-- Utilisation de mx-auto pour centrer le formulaire horizontalement -->
    <div class="mx-auto text-center mb-4"> <!-- Utilisation de mx-auto pour centrer le texte horizontalement et ajout de mb-4 pour plus d'espace en bas -->
        <h3>Formulaire de contact</h3>
        <p>Fill in the data below.</p>
    </div>
    <div class="form-group text-start col-md-12 mx-auto d-flex justify-content-center"> <!-- Utilisation de mx-auto pour centrer le formulaire horizontalement -->
        <div class="form-group col-md-2 mx-2">
            <label for="inputLastName">Nom</label>
            <input type="nom" class="form-control" id="inputLastName" placeholder="Nom">
        </div>
        <div class="form-group col-md-2 mx-2">
            <label for="inputFirstName">Prénom</label>
            <input type="prénom" class="form-control" id="inputFirstName" placeholder="Prénom">
        </div>
    </div>
    <div class="form-group col-md-12 mx-auto d-flex flex-column align-items-center justify-content-center"> <!-- Utilisation de mx-auto pour centrer le formulaire horizontalement -->
        <div class="form-group col-md-4 mx-2">
            <label for="inputEmail">E-mail</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Votre adresse e-mail">
        </div>
        <div class="form-group col-md-4 mx-2">
            <label for="inputChoice">Votre choix</label>
            <select id="inputChoice" class="form-control">
                <option selected>Aide juridique (avocatie)</option>
                <option>Formations</option>
            </select>
        </div>
        <div class="form-group col-md-4 mx-2">
            <label for="inputSubject">Sujet</label>
            <input type="subject" class="form-control" id="inputSubject" placeholder="Sujet">
        </div>
        <!-- Champ pour le message -->
        <div class="form-group col-md-4 mx-2">
            <label for="inputCity">Message</label>
            <textarea class="form-control bg-light-beige shadow" id="message" name="message" rows="5" maxlength="500" placeholder="Votre message"  required></textarea>
            <!-- Information sur la limite de caractères -->
        </div>
        <div class="form-group mx-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Toutes mes informations sont correctes.
                </label>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mx-4">Envoyer</button>
    </div>
</div>
</form>
</div>
<div class="m-4"></div> <!-- Ajout de la classe mb-4 pour ajouter de l'espace en bas -->


<?php
require_once dirname(__DIR__, 2) . '/utilities/composant_general/footer.php';
?>
