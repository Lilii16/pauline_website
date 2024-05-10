
<!-- Bouton pour enlever les paramètres d'URL -->
<!-- <button id="removeParamsButton">Enlever les paramètres d'URL</button> -->

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélection du bouton
    var button = document.getElementById('removeParamsButton');
    // var button = document.getElementsByClassName('removeParamsButton');

    // Ajout d'un écouteur d'événements sur le clic du bouton
    button.addEventListener('click', function() {
        // Récupérer l'URL actuelle
        var url = window.location.href;

        // Trouver l'index du premier "?" dans l'URL
        var index = url.indexOf("?");

        // Vérifier s'il y a un "?" dans l'URL
        if (index !== -1) {
            // Extraire la partie de l'URL avant le "?"
            var newUrl = url.substring(0, index);
            
            // Remplacer l'URL actuelle par la nouvelle URL sans les paramètres après le "?"
            window.history.replaceState({}, document.title, newUrl);
                // Actualiser la page
                window.location.reload();
        }
    });
});
</script> -->


<div class="d-flex flex-column flex-shrink-0 p-3 bg-wine col-2 vh-100">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4 text-light">
                        <?php output_username(); ?>
                    </span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto ">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link link-light text-center link-opacity-10-hover" aria-current="page">

                            Visualiser le site
                        </a>
                    </li>
                    <li>
                        <a class="nav-link link-beige active" id="questions-tab" data-toggle="tab" href="#questionsContent" role="tab" aria-controls="questions" aria-selected="false">Questions</a>
                    </li>
                    <li>
                        <a class="nav-link link-beige removeParamsButton"  id="articles-tab" data-toggle="tab" href="#articleContent" role="tab" aria-controls="articles" aria-selected="false">Articles</a>
                    </li>
                    <li>
                        <a class="nav-link link-beige" id="publications-tab" data-toggle="tab" href="#publicationContent" role="tab" aria-controls="publications" aria-selected="false">Publications</a>
                    </li>
                    <li>
                        <a class="nav-link link-beige" id="faq-formation-tab" data-toggle="tab" href="#faq_formationContent" role="tab" aria-controls="faq-formation" aria-selected="false">FAQ-formations</a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-beige text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/logos/logoFond.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>Pauline</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="#">Nous contacter</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> <a class="dropdown-item text-danger" href="./login/logout.php">Se déconnecter</a></li>

                    </ul>
                </div>
            </div>

