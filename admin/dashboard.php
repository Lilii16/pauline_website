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
</head>


<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Administration - Gestion du Droit du Travail</h1>
        <div class="d-flex justify-content-between">
        <h3><?php 
            output_username();
            ?></h3>

            <a href="../index.php">Visualiser le site</a>
            <a href="./login/logout.php">Se déconnecter</a>
        </div>

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
                <h2>Questions</h2>
                <!-- Tableau pour afficher les questions -->
                <!-- Structure du tableau -->
                <!-- Insérer les données dynamiquement ici -->
                <?php foreach ($questions as $index => $question) { ?>
                    <div class="accordion-item mb-4 shadow-sm">
                        <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
                                <?php echo $question['question']; ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>">
                            <div class="accordion-body">
                                <?php echo $question['reponse']; ?>
                            </div>
                        </div>

                        <!-- Boutons pour modifier la question -->
                        <div class="d-flex justify-content-end mt-2">
                            <a href="./CRUD/updateForm.php?type=question&id=<?php echo $question['id']; ?>" class="btn btn-warning me-2">Modifier</a>
                            <!-- Boutons pour  supprimer la question -->
                            <form action="./CRUD/confirmdelete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $question['id']; ?>">
                                <input type="hidden" name="type" value="question">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>

                        </div>
                    </div>
                <?php } ?>
                <!-- Bouton Ajouter -->
                <!-- pour envoyer le type, on peut utiliser deux méthodes: soit un lien dans laquel on précise le type
                (?type=question)=> méthode $GET, soit en formulaire avec la méthode POST dans lequel on rajoute 
                un input invisible avec (name = type value= question) -->
                <form action="./CRUD/addForm.php" method="get">
                    <input type="hidden" name="type" value="question">
                    <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
                </form>

            </div>

            <!-- Articles -->
            <div class="tab-pane fade" id="articlesContent" role="tabpanel" aria-labelledby="articles-tab">
                <h2>Articles</h2>
                <!-- Tableau pour afficher les articles -->
                <!-- Structure du tableau -->
                <!-- Insérer les données dynamiquement ici -->
                <?php foreach ($articles as $i => $article) { ?>
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
                        <a href="./CRUD/toUpdateForm.php?type=article&id=<?php echo $article['id']; ?>" class="btn btn-warning me-2">Modifier</a>
                        <form action="./CRUD/confirmdelete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                            <input type="hidden" name="type" value="article">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
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
                <?php foreach ($publications as $i => $publication) { ?>
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
                        <form action="./CRUD/confirmdelete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $publication['id']; ?>">
                            <input type="hidden" name="type" value="publication">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
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

                <?php foreach ($faq_formations as $index => $faq_formation) { ?>
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
                            <form action="./CRUD/confirmdelete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $faq_formation['id']; ?>">
                                <input type="hidden" name="type" value="faq_formation">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>

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




        </div>

    </div>

    <!-- Modal d'ajout de question -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
        <!-- Contenu du modal -->
    </div>

    <!-- Modal d'ajout d'article -->
    <div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="addArticleModalLabel" aria-hidden="true">
        <!-- Contenu du modal -->
    </div>

    <!-- Modal d'ajout de publication -->
    <div class="modal fade" id="addPublicationModal" tabindex="-1" role="dialog" aria-labelledby="addPublicationModalLabel" aria-hidden="true">
        <!-- Contenu du modal -->
    </div>

    <!-- Modal d'ajout de faq-formation -->
    <div class="modal fade" id="addFaq-formationModal" tabindex="-1" role="dialog" aria-labelledby="addFaq-formationModalLabel" aria-hidden="true">
        <!-- Contenu du modal -->
    </div>


    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/faqs/faq-2/assets/css/faq-2.css">
    <script src="https://unpkg.com/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>