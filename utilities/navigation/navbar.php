<!-- Conteneur principal de largeur 100% -->
<div class="w-100">
    <!-- Conteneur flexbox centré horizontalement -->
    <div class="d-flex justify-content-center">
        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg w-50 p-2 fixed-top mx-auto bg-orange" id="border">
            <!-- Bouton pour la navigation mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Icône du bouton-->
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Conteneur de la barre de navigation collapsée pour les écrans de petite taille -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Liste des éléments de la barre de navigation -->
                <ul class="d-flex w-100 justify-content-center space-around">
                    <!-- Ligne pour aligner les éléments de la barre de navigation horizontalement -->
                    <div class="row w-100 text-center">
                        <!-- Colonnes Bootstrap (responsive: permet d'aligner les elements de la navbar en format grand écran) -->
                           <!-- Div de menu "Accueil" -->
                        <div class="col-md">
                            <li class="nav-item flex-grow-1">
                                <!-- Lien vers la page d'accueil -->
                                <a class="link nav-link active " aria-current="page" href="index.php" id="link">Accueil</a>
                            </li>
                        </div>
                         <!-- Div de menu "Avocate" -->
                        <div class="col-md">
                            <li class="nav-item dropdown">
                                <!-- Lien de menu déroulant "Avocate" -->
                                <a class="nav-link dropdown-toggle link" href="avocate.php" id="navbarDropdownAvocate" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="link">
                                    Avocate
                                </a>
                                <!-- Menu déroulant pour les options liées à l'avocate -->
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownAvocate">
                                    <!-- Option "J'ai besoin d'une avocate" -->
                                    <li><a class="dropdown-item" href="avocate.php#competences-section">J'ai besoin d'une avocate</a></li>
                                    <!-- Ligne de séparation dans le menu déroulant -->
                                    <li><hr class="dropdown-divider"></li>
                                    <!-- Option "Cas pratiques" -->
                                    <li><a class="dropdown-item" href="avocate.php#questions-section">Cas pratiques</a></li>
                                    <!-- Ligne de séparation dans le menu déroulant -->
                                    <li><hr class="dropdown-divider"></li>
                                    <!-- Option "Honoraires" -->
                                    <li><a class="dropdown-item" href="avocate.php#honoraires-section">Honoraires</a></li>
                                </ul>
                            </li>
                        </div>
                          <!-- Div de menu "Formatrice" -->
                        <div class="col-md">
                            <li class="nav-item dropdown">
                                <!-- Lien de menu déroulant "Formatrice" -->
                                <a class="nav-link dropdown-toggle link" href="formations.php" id="navbarDropdownFormatrice" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="link">
                                    Formatrice
                                </a>
                                <!-- Menu déroulant pour les options liées à la formatrice -->
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownFormatrice">
                                    <!-- Option "J'ai besoin de me former" -->
                                    <li><a class="menu dropdown-item" href="formations.php#thematik-section">J'ai besoin de me former</a></li>
                                    <!-- Ligne de séparation dans le menu déroulant -->
                                    <li><hr class="dropdown-divider"></li>
                                    <!-- Option "FAQ" -->
                                    <li><a class="menu dropdown-item" href="formations.php#faq-section">FAQ</a></li>
                                    <!-- Ligne de séparation dans le menu déroulant -->
                                    <li><hr class="dropdown-divider"></li>
                                    <!-- Option "Demander un devis" -->
                                    <li><a class="menu dropdown-item" href="formations.php#devis-section">Demander un devis</a></li>
                                </ul>
                            </li>
                        </div>
                         <!-- Div de menu "Contact" -->
                        <div class="col-md">
                            <li class="nav-item flex-grow-1">
                                <!-- Lien vers la page de contact -->
                                <a class="nav-link link" aria-disabled="true" href="contact.php" id="link">Contact</a>
                            </li>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
</div>



<script>
// Récupération de l'élément ayant l'ID "border" du document HTML
var border = document.getElementById("border");

// Sélection de tous les éléments avec la classe CSS ".link" du document HTML
var links = document.querySelectorAll(".link");

// Pour chaque élément de la liste des liens sélectionnés
links.forEach(function(link) {
    // Ajout d'un écouteur d'événement pour l'événement "mouseover" (survol de la souris)
    link.addEventListener("mouseover", function() {
        // Changement du style de bordure de l'élément avec l'ID "border" lors du survol de la souris sur le lien
        border.style.border = "2px solid #0010a3";
    });

    // Ajout d'un écouteur d'événement pour l'événement "mouseout" (déplacement de la souris hors du lien)
    link.addEventListener("mouseout", function() {
        // Rétablissement du style de bordure initial de l'élément avec l'ID "border" lorsque la souris quitte le lien
        border.style.border = "2px solid #f5ecd4";
    });
});

</script>


</div>