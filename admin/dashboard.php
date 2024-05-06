<?php
require_once "./Components/header.php"
?>

    <!-- <script src="js/script_section.js"></script> -->
    <script >
          document.addEventListener('DOMContentLoaded', function() {
        // Récupère la section spécifiée dans l'URL
        var section = '<?php echo isset($_GET["section"]) ? $_GET["section"] : ""; ?>';

        // Si une section est spécifiée, active l'onglet correspondant
        if (section) {
            var tabPane = document.getElementById(section);
            if (tabPane) {
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
                $nombre_articles = count($articles);
                $nombre_questions = count($questions);
                $nombre_publications = count($publications);
                $nombre_faq_formation = count($faq_formations);
                ?>

                <!-- Tab panes -->
                <div class="tab-content">

                    <!-- Questions -->
                    <div class="tab-pane fade show active" id="questionsContent" role="tabpanel" aria-labelledby="questions-tab">
                        <!-- Tableau pour afficher les questions -->

                        <!-- dash example -->
                    
                        <div class="card dashcard">
                            <div class="card-header border-bottom d-flex justify-content-between text-light">
                                <h5 class="mb-0">Gestion des question sur conseil juridique</h5>
                                <!-- bouton pour ajouter la question -->

                                <!-- tu travailles ici -->
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-add text-light" data-toggle="modal" data-target="#myModal" data-action="ajouter" data-type="question"> <i class="fa fa-plus text-warning" aria-hidden="true"></i>
                                    <span>Ajouter un nouveau</span></button>

                            </div>
                            <div class="table-responsive bg-duck">
                                <table class="table table-nowrap">
                                    <thead class="bg-rouille">
                                        <tr class="align-middle">
                                            <th scope="col">Question</th>
                                            <th scope="col">Dernière modification</th>
                                            <th scope="col">Afficher Tout</th>
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- debut boucle -->
                                        <!-- Tableau pour afficher les questions -->
                                        <?php

                                        foreach ($questions as $index => $question) {
                                        ?> <tr>
                                                <td>
                                                    <?php echo $question['question']; ?>
                                                </td>
                                                <td><?php echo $question['last_modified_date']; ?></td>

                                                <!-- Boutons pour afficher la question et la réponse -->
                                                <td>
                                                    <!-- tu travailles ici -->
                                                    <button type="button" class="btn btn-light trigger-btn-view" data-toggle="modal" data-target="#myModal" data-action="afficher" data-type="question" data-id="<?php echo $question['id']; ?>" data-title="<?php echo $question['question']; ?>" data-description="<?php echo $question['reponse']; ?>">
                                                        Afficher</button>
                                                </td>
                                                <!-- Boutons pour modifier la question -->
                                                <td>
                                                    <button type="button" class="btn btn-light trigger-btn-modify" data-toggle="modal" data-target="#myModal" data-action="modifier" data-type="question" data-id="<?php echo $question['id']; ?>" data-title="<?php echo $question['question']; ?>" data-description="<?php echo $question['reponse']; ?>">
                                                        Modifier</button>
                                                </td>
                                                <!-- tu travailles ici --> <!-- Boutons pour supprimer la question -->
                                                <td class="text-end">
                                                    <button type="button" class="btn  btn-sm btn-square btn-neutral btn-light trigger-btn-delete" data-toggle="modal" data-target="#myModal" data-action="supprimer" data-type="question" data-id="<?php echo $question['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                                </td>
                                            </tr>

                                        <?php
                                        } ?>
                                        <!-- fin boucle -->

                                    </tbody>


                                </table>
                                <div class="text-center">
                                    <h6> Nombre total d'elements: <?php echo " $nombre_questions"; ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Articles -->
                    <div class="tab-pane fade" id="articleContent" role="tabpanel" aria-labelledby="articles-tab">

                        <!-- dash example -->
                        <div class="card" style="height: calc(100vh - 130px);">
                            <div class="card-header border-bottom d-flex justify-content-between text-light">
                                <h5 class="mb-0">Gestion des articles sur page d'accueil</h5>
                                <!-- bouton pour ajouter la question -->

                                <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-add text-light" data-toggle="modal" data-target="#myModal" data-action="ajouter" data-type="article"> <i class="fa fa-plus text-warning" aria-hidden="true"></i>
                                    <span>Ajouter un nouveau</span></button>

                            </div>
                            <div class="table-responsive bg-duck">
                                <table class="table table-hover table-nowrap">
                                    <thead class="bg-rouille">
                                        <tr class="align-middle">
                                            <th scope="col">Article</th>
                                            <th scope="col">Dernière modification</th>
                                            <th scope="col">Afficher Tout</th>
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- debut boucle -->
                                        <!-- Tableau pour afficher les questions -->
                                        <?php

                                        foreach ($articles as $i => $article) {
                                        ?> <tr>
                                                <td>
                                                    <?php echo $article['title']; ?>
                                                </td>
                                                <td><?php echo $article['last_modified_date']; ?></td>
                                                <!-- Boutons pour afficher l'article et la réponse -->
                                                <td>
                                                    <!-- tu travailles ici -->
                                                    <button type="button" class="btn btn-light trigger-btn-view" data-toggle="modal" data-target="#myModal" data-action="afficher" data-type="article" data-id="<?php echo $article['id']; ?>" data-title="<?php echo $article['title']; ?>" data-description="<?php echo $article['deskription']; ?>" data-lien="<?php echo $article['origine']; ?>">
                                                        Afficher</button>
                                                </td>
                                                <!-- Boutons pour modifier l'article' -->
                                                <td>
                                                    <button type="button" class="btn btn-light trigger-btn-modify" data-toggle="modal" data-target="#myModal" data-action="modifier" data-type="article" data-id="<?php echo $article['id']; ?>" data-title="<?php echo $article['title']; ?>" data-description="<?php echo $article['deskription']; ?>" data-lien="<?php echo $article['origine']; ?>">
                                                        Modifier</button>
                                                </td>
                                                <!-- tu travailles ici --> <!-- Boutons pour supprimer l'article -->
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-delete" data-toggle="modal" data-target="#myModal" data-action="supprimer" data-type="article" data-id="<?php echo $article['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                                </td>
                                            </tr>

                                        <?php
                                        } ?>

                                        <!-- fin boucle -->
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <h6> Nombre total d'elements: <?php echo " $nombre_articles"; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Publications -->
                    <div class="tab-pane fade" id="publicationContent" role="tabpanel" aria-labelledby="publications-tab">


                        <!-- dash example -->
                        <div class="card" style="height: calc(100vh - 130px);">
                            <div class="card-header border-bottom d-flex justify-content-between text-light">
                                <h5 class="mb-0">Gestion des Publications sur page d'accueil</h5>
                                <!-- bouton pour ajouter la question -->

                                <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-add text-light" data-toggle="modal" data-target="#myModal" data-action="ajouter" data-type="publication"> <i class="fa fa-plus text-warning" aria-hidden="true"></i>
                                    <span>Ajouter un nouveau</span></button>

                            </div>
                            <div class="table-responsive bg-duck">
                                <table class="table table-hover table-nowrap">
                                    <thead class="bg-rouille">
                                        <tr class="align-middle">
                                            <th scope="col">Publication</th>
                                            <th scope="col">Dernière modification</th>
                                            <th scope="col">Afficher Tout</th>
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- debut boucle -->
                                        <!-- Tableau pour afficher les questions -->
                                        <?php

                                        foreach ($publications as $i => $publication) {
                                        ?> <tr>
                                                <td>
                                                    <?php echo $publication['titre']; ?>
                                                </td>
                                                <td><?php echo $publication['last_modified_date']; ?></td>
                                                <!-- Boutons pour afficher la publication et la réponse -->
                                                <td>
                                                    <!-- tu travailles ici -->
                                                    <button type="button" class="btn btn-light trigger-btn-view" data-toggle="modal" data-target="#myModal" data-action="afficher" data-type="publication" data-id="<?php echo $publication['id']; ?>" data-title="<?php echo $publication['titre']; ?>" data-description="<?php echo $publication['description']; ?>" data-lien="<?php echo $publication['source']; ?>">
                                                        Afficher</button>
                                                </td>
                                                <!-- Boutons pour modifier la publication' -->
                                                <td>
                                                    <button type="button" class="btn btn-light trigger-btn-modify" data-toggle="modal" data-target="#myModal" data-action="modifier" data-type="publication" data-id="<?php echo $publication['id']; ?>" data-title="<?php echo $publication['titre']; ?>" data-description="<?php echo $publication['description']; ?>" data-lien="<?php echo $publication['path']; ?>" data-source="<?php echo $publication['source']; ?>">
                                                        Modifier</button>
                                                </td>
                                                <!-- tu travailles ici --> <!-- Boutons pour supprimer la publication -->
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-delete" data-toggle="modal" data-target="#myModal" data-action="supprimer" data-type="publication" data-id="<?php echo $publication['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                                </td>
                                            </tr>

                                        <?php
                                        } ?>
                                        <!-- fin boucle -->
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <h6> Nombre total d'elements: <?php echo " $nombre_publications"; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- faq-formation -->
                    <div class="tab-pane fade" id="faq_formationContent" role="tabpanel" aria-labelledby="faq-formation-tab">


                        <!-- dash example -->
                        <div class="card" style="height: calc(100vh - 130px);">
                            <div class="card-header border-bottom d-flex justify-content-between text-light">
                                <h5 class="mb-0">Gestion des faq_formations sur conseil juridique</h5>
                                <!-- bouton pour ajouter la faq_formations -->

                                <!-- tu travailles ici -->
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-add text-light" data-toggle="modal" data-target="#myModal" data-action="ajouter" data-type="faq_formation"> <i class="fa fa-plus text-warning" aria-hidden="true"></i>
                                    <span>Ajouter un nouveau</span></button>

                            </div>
                            <div class="table-responsive bg-duck">
                                <table class="table table-hover table-nowrap">
                                    <thead class="bg-rouille">
                                        <tr class="align-middle">
                                            <th scope="col">Faq_formations</th>
                                            <th scope="col">Dernière modification</th>
                                            <th scope="col">Afficher Tout</th>
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- debut boucle -->
                                        <!-- Tableau pour afficher les faq_formations -->
                                        <?php

                                        foreach ($faq_formations as $index => $faq_formation) {
                                        ?> <tr>
                                                <td>
                                                    <?php echo $faq_formation['question']; ?>

                                                </td>
                                                <td><?php echo $faq_formation['last_modified_date']; ?></td>
                                                <!-- Boutons pour afficher la faq_formations et la réponse -->
                                                <td>
                                                    <!-- tu travailles ici -->
                                                    <button type="button" class="btn btn-light trigger-btn-view" data-toggle="modal" data-target="#myModal" data-action="afficher" data-type="faq_formation" data-id="<?php echo $faq_formation['id']; ?>" data-title="<?php echo $faq_formation['question']; ?>" data-description="<?php echo $faq_formation['reponse']; ?>">
                                                        Afficher</button>
                                                </td>
                                                <!-- Boutons pour modifier la faq_formations -->
                                                <td>
                                                    <button type="button" class="btn btn-light trigger-btn-modify" data-toggle="modal" data-target="#myModal" data-action="modifier" data-type="faq_formation" data-id="<?php echo $faq_formation['id']; ?>" data-title="<?php echo $faq_formation['question']; ?>" data-description="<?php echo $faq_formation['reponse']; ?>">
                                                        Modifier</button>
                                                </td>
                                                <!-- tu travailles ici --> <!-- Boutons pour supprimer la faq_formations -->
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-delete" data-toggle="modal" data-target="#myModal" data-action="supprimer" data-type="faq_formation" data-id="<?php echo $faq_formation['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                                </td>
                                            </tr>

                                        <?php
                                        } ?>
                                        <!-- fin boucle -->
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <h6> Nombre total d'elements: <?php echo " $nombre_faq_formation"; ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
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

</body>

</html>