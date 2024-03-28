<div class="m-5 p-2"></div>
<div class="w-100 mt-5 bg-red vh-100 radius p-4 relative">
    <form class="d-flex align-items-center justify-content-center inner-radius bg-light-50-beige mt-auto mx-auto absolute col-md-8">
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
                        <input type="nom" class="form-control shadow rounded-4 bg-beige" id="inputLastName" placeholder="Nom">
                    </div>
                    <div class="form-group col mb-4">
                        <input type="prénom" class="form-control shadow rounded-4 bg-beige" id="inputFirstName" placeholder="Prénom">
                    </div>
                </div>
                <!-- reste des infos -->
                <div class="form-group d-flex flex-column justify-content-center mb-4">

                <!-- div mail -->
                    <div class="form-group mb-4">
                        <input type="email" class="form-control shadow rounded-5 bg-beige" id="inputEmail" placeholder="Votre adresse e-mail">
                    </div>
                    <!-- div selecteur -->
                    <div class="form-group mb-4">
                        <!-- selecteur de sujet -->
                        <label for="inputChoice">Votre choix</label>
                        <select id="inputChoice" class="selectedOption form-control shadow rounded-5 bg-beige">
                            <option selected>Aide juridique (avocatie)</option>
                            <option>Formations</option>
                        </select>
                    </div>
                    <!-- div sujet -->
                    <div class="form-group mb-4">
                        <input type="subject" class="form-control rounded-5 bg-beige" id="inputSubject" placeholder="Sujet">
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