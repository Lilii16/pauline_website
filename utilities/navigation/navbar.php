<?php// Inclure page_avocate.php
require "../utilities/autres_composants/page_avocate.php";
// Inclure page_formations.php
require '../utilities/autres_composants/page_formations.php';
?>
<div class="w-100">
    <div class="d-flex justify-content-center">
        <nav class="bg-bk navbar navbar-expand-lg border-nav w-50 p-2 fixed-top mx-auto" id="border">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex w-100 justify-content-center space-around">
                    <div class="row w-100 text-center">
                        <div class="col-md">
                            <li class="nav-item flex-grow-1">
                                <a class="link nav-link active " aria-current="page" href="index.php" id="link">Accueil</a>
                            </li>
                        </div>
                        <div class="col-md">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle link" href="avocate.php" id="navbarDropdownAvocate" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="link">
                                    Avocate
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownAvocate">
                                    <li><a class="dropdown-item" href="page_avocate.php#competences-section">J'ai besoin d'une avocate</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="page_avocate.php#questions-section">Cas pratiques</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="page_avocate.php#honoraires-section">Honoraires</a></li>
                                </ul>
                            </li>
                        </div>
                        <div class="col-md">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle link" href="formations.php" id="navbarDropdownFormatrice" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="link">
                                    Formatrice
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownFormatrice">
                                    <li><a class="menu dropdown-item" href="page_formations.php#thematik-section">J'ai besoin de me former</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="menu dropdown-item" href="page_formations.php#faq-section">FAQ</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="menu dropdown-item" href="page_formations.php#devis-section">Demander un devis</a></li>
                                </ul>
                            </li>
                        </div>
                        <div class="col-md">
                            <li class="nav-item flex-grow-1">
                                <a class="nav-link link" aria-disabled="true" href="contact.php" id="link">Contact</a>

                            </li>
                        </div>
                    </div>
                </ul>
            </div>
    </div>
    </nav>
</div>



<script>
    var border = document.getElementById("border");
    var links = document.querySelectorAll(".link");

    links.forEach(function(link) {
        link.addEventListener("mouseover", function() {
            border.style.border = "2px solid #0010a3";
        });

        link.addEventListener("mouseout", function() {
            border.style.border = "2px solid #f5ecd4";
        });
    });
</script>


</div>