<?php
require_once "./Components/header.php"
?>

<!-- <script src="js/script_section.js"></script> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Récupère la section spécifiée dans l'URL
        var section = '<?php echo isset($_GET["section"]) ? $_GET["section"] : ""; ?>';

        // Si une section est spécifiée, active l'onglet correspondant
        if (section) {
            // recupere l'id de la tab de l'url stocké dans section
            var tabPane = document.getElementById(section);
            if (tabPane) {
                // ouverture de la tab content
                var tabId = tabPane.getAttribute("aria-labelledby");
                var tab = document.getElementById(tabId);
                if (tab) {
                    tab.click(); // Active l'onglet
                }
            }
        }
    });
</script>
<div class="">
    <?php

    // Vérifier si un message de succès est présent dans la session
    if (isset($_SESSION['success_message'])) {
        // Afficher le message de succès
        echo '<div class="alert alert-success text-center position-absolute w-100 session" role="alert"> <h6>' .  $_SESSION['success_message'] . '</h6> </div>';

        // Supprimer le message de succès de la session pour éviter qu'il ne soit affiché à nouveau
        unset($_SESSION['success_message']);
    }
    ?>
    <!-- JavaScript pour masquer le message de succès après 3 secondes -->
    <script src="js/hide_message.js"></script>
    <script>
        hideSuccessMessage()
    </script>
    <div class="d-flex dashboard">

        <!-- side bar navigation -->
        <?php include "./Components/navBar.php" ?>
        <!-- fin side bar -->

        <div class="col background-image">
            <h1 class="mt-5 mb-4 text-light text-center">Administration - Gestion du Droit de la santé mentale</h1>

            <?php

            $questions = findAllQuestions($conn);
            $articles = findAllArticles($conn);
            $publications = findAllPublications($conn);
            $faq_formations = findAllQuestionsFormation($conn);
            // compteurs d'elements
            $nombre_articles = count($articles);
            $nombre_questions = count($questions);
            $nombre_publications = count($publications);
            $nombre_faq_formation = count($faq_formations);
            // initialiser la variable trie pour le filtre de selection
            $tri = isset($_POST['tri']) ? $_POST['tri'] : '';
            ?>

            <!-- Système d'onglets  -->
            <div class="tab-content">

                <!-- Questions -->
                <?php include './Components/dashboard/questions.php' ?>

                <!-- Articles -->
                <?php include './Components/dashboard/articles.php' ?>

                <!-- Publications -->
                <?php include './Components/dashboard/publications.php'?>

                <!-- faq-formation -->
                <?php include './Components/dashboard/faq_formations.php'?>
                <!-- fin div tab pans -->
            </div>
            <!-- div col body -->
        </div>
        <!-- fin div d-flex -->
    </div>
    <!-- fin div container -->
</div>


<!-- Modale generale -->
<?php
include './Components/modal_view.php'
?>
<!-- script pour ajouter -->
<script src="js/modal_script.js"></script>



<!--script gestion url-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionnez tous les liens de navigation
        const navLinks = document.querySelectorAll('.nav-link');

        // Ajoutez un gestionnaire d'événements à chaque lien
        navLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                // Empêchez le comportement par défaut du lien
                event.preventDefault();

                // Récupérez l'URL associée au lien
                const href = link.getAttribute('href');

                // Analysez l'URL actuelle
                const url = new URL(window.location.href);

                // Récupérez les paramètres de la requête actuelle
                const params = new URLSearchParams(url.search);

                // Remplacez ou ajoutez la pagination
                params.set('page', '1');

                // Remplacez la section dans l'URL actuelle par celle du lien
                const section = href.split('#')[1];
                params.set('section', section);

                // Construisez la nouvelle URL
                const newUrl = url.origin + url.pathname + '?' + params.toString() ;

                // Redirigez vers la nouvelle URL
                window.location.href = newUrl;
            });
        });
    });
</script>


</body>

</html>