<?php
require_once '../config/conn.php';
require_once '../function/database.fn.php';
require_once dirname(__DIR__) . '/function/questions.fn.php';
require_once dirname(__DIR__) . '/function/publications.fn.php';
require_once dirname(__DIR__) . '/function/articles.fn.php';
require_once dirname(__DIR__) . '/function/faq_formations.fn.php';

require_once './login/includes/config_session.inc.php';
require_once './login/includes/login_view.inc.php';



//vérifie si on s'est connécté sinon redirection vers page de connexion
// session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login/login.poo.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion du Droit à la Santé mentale</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- autres liens -->

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/faqs/faq-2/assets/css/faq-2.css">
    <script src="https://unpkg.com/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>



<body>
    <div class="">
    <?php

// Vérifier si un message de succès est présent dans la session
if(isset($_SESSION['success_message'])) {
    // Afficher le message de succès
    echo '<div class="alert alert-success text-center position-absolute w-100 session" role="alert">' . $_SESSION['success_message'] . '</div>';

    // Supprimer le message de succès de la session pour éviter qu'il ne soit affiché à nouveau
    unset($_SESSION['success_message']);
}
?>
<!-- JavaScript pour masquer le message de succès après 3 secondes -->
<script>
    // Sélectionne l'élément contenant le message de succès
    var successMessage = document.querySelector('.session');

    // Si l'élément existe
    if(successMessage) {
        // Masque l'élément après 3 secondes
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 6000); // 6sec
    }
</script>

     <div class="d-flex">
            
            <!-- side bar -->
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-wine col-2 vh-100">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                    <span class="fs-4 text-light">

                        <?php
                        output_username();
                        ?>

                    </span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto ">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link link-light text-center" aria-current="page">

                            Visualiser le site
                        </a>
                    </li>
                    <li>
                        <a class="nav-link link-beige active " id="questions-tab" data-toggle="tab" href="#questionsContent" role="tab" aria-controls="questions" aria-selected="false">Questions</a>
                    </li>
                    <li>
                        <a class="nav-link link-beige" id="articles-tab" data-toggle="tab" href="#articlesContent" role="tab" aria-controls="articles" aria-selected="false">Articles</a>
                    </li>
                    <li>
                        <a class="nav-link link-beige" id="publications-tab" data-toggle="tab" href="#publicationsContent" role="tab" aria-controls="publications" aria-selected="false">Publications</a>
                    </li>
                    <li>
                        <a class="nav-link link-beige" id="faq-formation-tab" data-toggle="tab" href="#faq-formationContent" role="tab" aria-controls="faq-formation" aria-selected="false">FAQ-formations</a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-beige text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/logos/logoFond.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>Pauline</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="">
                        <li><a class="dropdown-item" href="#">Nous contacter</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> <a class="dropdown-item text-danger" href="./login/logout.php">Se déconnecter</a></li>

                    </ul>
                </div>
            </div>

            <!-- fin side bar -->

            <div class="col background-image">
                <h1 class="mt-5 mb-4 text-light text-center">Administration - Gestion du Droit de la santé mentale</h1>



                <!-- Nav tabs -->
                <!-- <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="questions-tab" data-toggle="tab" href="#questionsContent" role="tab" aria-controls="questions" aria-selected="false">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="articles-tab" data-toggle="tab" href="#articlesContent" role="tab" aria-controls="articles" aria-selected="false">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="publications-tab" data-toggle="tab" href="#publicationsContent" role="tab" aria-controls="publications" aria-selected="false">Publications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="faq-formation-tab" data-toggle="tab" href="#faq-formationContent" role="tab" aria-controls="faq-formation" aria-selected="false">FAQ-formations</a>
                    </li>
                </ul> -->

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
                        <div class="card" style="height: calc(100vh - 130px);">
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
                                                    <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-delete" data-toggle="modal" data-target="#myModal" data-action="supprimer" data-type="question" data-id="<?php echo $question['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

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
                    <div class="tab-pane fade" id="articlesContent" role="tabpanel" aria-labelledby="articles-tab">

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
                                                <td>23-01-2022</td>
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
                    <div class="tab-pane fade" id="publicationsContent" role="tabpanel" aria-labelledby="publications-tab">


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
                                                <td>23-01-2022</td>
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
                    <div class="tab-pane fade" id="faq-formationContent" role="tabpanel" aria-labelledby="faq-formation-tab">


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
                                                <td>23-01-2022</td>
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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-confirm ">
            <div class="modal-content bg-beige">
                <div class="modal-header flex-column">
                    <h4 id="modal-title" class="modal-title w-100"></h4>
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-column justify-content-center align-items-center container col-md-10">
                        <!-- Affichage dynamique du formulaire en fonction du type -->
                        <div id="add-form-content" class="col-12"></div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary col-6" data-dismiss="modal">Annuler</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- script pour ajouter -->
    <script src="modal_script.js"></script>

</body>

</html>