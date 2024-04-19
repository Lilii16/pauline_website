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
        <div class="d-flex">

            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light col-2">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                    <span class="fs-4">

                        <?php
                        output_username();
                        ?>

                    </span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link active" aria-current="page">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#home"></use>
                            </svg>
                            Visualiser le site
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#speedometer2"></use>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#table"></use>
                            </svg>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#grid"></use>
                            </svg>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#people-circle"></use>
                            </svg>
                            Customers
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
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

            <div class="col">
                <h1 class="mt-5 mb-4">Administration - Gestion du Droit de la santé mentale</h1>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
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
                </ul>

                <?php

                $questions = findAllQuestions($conn);
                $articles = findAllArticles($conn);
                $publications = findAllPublications($conn);
                $faq_formations = findAllQuestionsFormation($conn);
                ?>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Questions -->
                    <div class="tab-pane fade show active" id="questionsContent" role="tabpanel" aria-labelledby="questions-tab">
                        <!-- <h2 class="my-3 text-center row">Questions</h2> -->
                        <!-- Tableau pour afficher les questions -->

                        <!-- dash example -->
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-between">
                                <h5 class="mb-0">Gestion des question sur conseil juridique</h5>
                                <!-- bouton pour ajouter la question -->
                               
  <!-- tu travailles ici -->
                                <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-add" data-toggle="modal" data-target="#myModal" data-action="ajouter" data-type="question"> <i class="fa fa-plus text-warning" aria-hidden="true"></i>
                                    <span>Ajouter un nouveau</span></button>

                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Question</th>
                                            <th scope="col">Dernière modification</th>
                                            <th scope="col">Afficher Tout</th>
                                            <th scope="col">Modifier</th>
                                            <th scope="col">Supprimer</th>
                                            <th></th>
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
                                                <td>23-01-2022</td>
                                                <!-- Boutons pour afficher la question et la réponse -->
                                                <td>
                                                    <!-- <button type="button" class="btn btn-light"><i class="bg-warning"></i>Afficher</button> -->
   <!-- tu travailles ici -->           
                                                    <button type="button" class="btn btn-light trigger-btn-view" data-toggle="modal" data-target="#myModal"  data-action="afficher"  data-type="question" data-id="<?php echo $question['id']; ?>"  data-question="<?php echo $question['question']; ?>" data-response="<?php echo $question['reponse']; ?>">
                                                    Afficher</button>
                                                </td>

                                        
                                                <!-- Boutons pour modifier la question -->
                                                <td>
                                                <button type="button" class="btn btn-light trigger-btn-modify" data-toggle="modal" data-target="#myModal"  data-action="modifier"  data-type="question" data-id="<?php echo $question['id']; ?>" data-question="<?php echo $question['question']; ?>" data-response="<?php echo $question['reponse']; ?>">
                                                    Modifier</button>
                                                </td>
                                              

   <!-- tu travailles ici -->               <!-- Boutons pour supprimer la question -->
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-delete" data-toggle="modal" data-target="#myModal"  data-action="supprimer"  data-type="question" data-id="<?php echo $question['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                                </td>
                                            </tr>

                                        <?php
                                        } ?>
                                        <!-- fin boucle -->


                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Articles -->
                    <div class="tab-pane fade" id="articlesContent" role="tabpanel" aria-labelledby="articles-tab">
                        <h2>Articles</h2>
                        <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-add" data-toggle="modal" data-target="#myModal" data-action="ajouter" data-type="article"> <i class="fa fa-plus text-warning" aria-hidden="true"></i>
                                    <span>Ajouter un nouveau</span></button>
                        <!-- Tableau pour afficher les articles -->
                        <!-- Structure du tableau -->
                        <!-- Insérer les données dynamiquement ici -->
                        <?php foreach ($articles as $i => $article) {
                            // $type = "article";
                        ?>
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <div class="col">
                                    <div class="card p-3">
                                        <h5 class="card-title heading <?php echo $i; ?>" id="heading<?php echo $article['title']; ?>"><?php echo $article['title']; ?></h5>
                                        <div class="card-body">
                                            <p> <?php echo $article['deskription']; ?></p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">
                                                <a href="<?php echo $article['origine']; ?>"><?php echo $article['origine']; ?></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Boutons pour modifier et supprimer l'article -->
                            <div class="d-flex justify-content-end mt-2">
                                <a href="./CRUD/updateForm.php?type=article&id=<?php echo $article['id']; ?>" class="btn btn-warning me-2">Modifier</a>

                                <button type="button" class="btn btn-primary trigger-btn" data-toggle="modal" data-target="#myModal" data-type="article" data-id="<?php echo $article['id']; ?>">
                                    Supprimer
                                </button>

                            </div>

                        <?php } ?>
                        <!-- Bouton Ajouter -->
                        <form action="./CRUD/addForm.php" method="get">
                            <input type="hidden" name="type" value="article">
                            <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
                        </form>
                    </div>
                    <!-- Publications -->
                    <div class="tab-pane fade" id="publicationsContent" role="tabpanel" aria-labelledby="publications-tab">
                        <h2>Publications</h2>
                        <!-- Tableau pour afficher les articles -->
                        <!-- Structure du tableau -->
                        <!-- Insérer les données dynamiquement ici -->
                        <?php foreach ($publications as $i => $publication) {
                            // $type = "publication";
                        ?>

                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <div class="col">
                                    <div class="card p-3">
                                        <h5 class="card-title heading<?php echo $i; ?>" id="heading<?php echo $publication['titre']; ?>"><?php echo $publication['titre']; ?></h5>
                                        <div class="card-body">
                                            <p> <?php echo $publication['description']; ?></p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">
                                                <p> <?php echo $publication['source']; ?>"><?php echo $publication['source']; ?></p>
                                            </small>
                                            <small class="text-muted">
                                                <a href="<?php echo $publication['lien']; ?>"><?php echo $publication['lien']; ?></a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Boutons pour modifier et supprimer l'article -->
                            <div class="d-flex justify-content-end mt-2">
                                <a href="./CRUD/toUpdateForm.php?type=publication&id=<?php echo $publication['id']; ?>" class="btn btn-warning me-2">Modifier</a>
                                <button type="button" class="btn btn-primary trigger-btn" data-toggle="modal" data-target="#myModal" data-type="publication" data-id="<?php echo $publication['id']; ?>">
                                    Supprimer
                                </button>
                            </div>

                        <?php } ?>
                        <!-- Bouton Ajouter -->
                        <form action="./CRUD/addForm.php" method="get">
                            <input type="hidden" name="type" value="publication">
                            <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
                        </form>
                    </div>
                    <!-- faq-formation -->
                    <div class="tab-pane fade" id="faq-formationContent" role="tabpanel" aria-labelledby="faq-formation-tab">
                        <h2>FAQ-formations</h2>
                        <!-- Tableau pour afficher les questions -->

                        <?php foreach ($faq_formations as $index => $faq_formation) {
                            // $type = "faq_formation";
                        ?>
                            <div class="accordion-item mb-4 shadow-sm">
                                <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                                    <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
                                        <?php echo $faq_formation['question']; ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>">
                                    <div class="accordion-body">
                                        <?php echo $faq_formation['reponse']; ?>
                                    </div>
                                </div>

                                <!-- Boutons pour modifier la question -->
                                <div class="d-flex justify-content-end mt-2">
                                    <a href="./CRUD/toUpdateForm.php?type=faq_formation&id=<?php echo $faq_formation['id']; ?>" class="btn btn-warning me-2">Modifier</a>
                                    <!-- Boutons pour  supprimer la question -->
                                    <button type="button" class="btn btn-primary trigger-btn" data-toggle="modal" data-target="#myModal" data-type="faq_formation" data-id="<?php echo $faq_formation['id']; ?>">
                                        Supprimer
                                    </button>

                                </div>
                            </div>
                        <?php } ?>
                        <!-- Bouton Ajouter -->
                        <!-- pour envoyer le type, on peut utiliser deux méthodes: soit un lien dans laquel on précise le type
                (?type=question)=> méthode $GET, soit en formulaire avec la méthode POST dans lequel on rajoute 
                un input invisible avec (name = type value= question) -->
                        <form action="./CRUD/addForm.php" method="get">
                            <input type="hidden" name="type" value="faq_formation">
                            <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
                        </form>
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
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <!-- affichage dynamique titre en js -->
              
                    <!-- <h4 class="modal-title w-100">Ajouter</h4> -->
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <!-- Affichage dynamique du formulaire en fonction du type -->
                            <div id="add-form-content"></div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
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

