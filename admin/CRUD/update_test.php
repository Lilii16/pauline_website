<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';
require_once dirname(__DIR__, 2) . '/function/publications.fn.php';
require_once dirname(__DIR__, 2) . '/function/faq_formations.fn.php';

function handleFormSubmission($conn) {
    // Vérifie si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifie si les données nécessaires sont présentes dans $_POST
        if(isset($_POST['type']) && isset($_POST['action'])) {
            $type = $_POST['type'];
            $action = $_POST['action'];

            // Selon le type et l'action, exécute la fonction appropriée
            switch($type) {
                case 'question':
                    handleQuestionForm($conn, $action);
                    break;
                case 'article':
                    handleArticleForm($conn, $action);
                    break;
                case 'publication':
                    handlePublicationForm($conn, $action);
                    break;
                case 'faq_formation':
                    handleFaqFormationForm($conn, $action);
                    break;
                default:
                    // Gérer d'autres types si nécessaire
                    break;
            }
        } else {
            // Gérer si des données sont manquantes dans $_POST
        }
    }
}

function handleQuestionForm($conn, $action) {
    // Vérifie si les données nécessaires sont présentes dans $_POST
    if(isset($_POST['question']) && isset($_POST['reponse'])) {
        $question = $_POST['question'];
        $reponse = $_POST['reponse'];

        // Exécute l'action appropriée selon la valeur de $action
        switch($action) {
            case 'ajouter':
                addQuestion($conn, $question, $reponse);
                break;
            case 'modifier':
                // Vérifie si l'ID de la question est également présent dans $_POST
                if(isset($_POST['question_id'])) {
                    $question_id = $_POST['question_id'];
                    modifyQuestion($conn, $question_id, $question, $reponse);
                } else {
                    // Gérer si l'ID de la question est manquant
                }
                break;
            case 'supprimer':
                // Vérifie si l'ID de la question est également présent dans $_POST
                if(isset($_POST['question_id'])) {
                    $question_id = $_POST['question_id'];
                    deleteQuestion($conn, $question_id);
                } else {
                    // Gérer si l'ID de la question est manquant
                }
                break;
            default:
                // Gérer d'autres actions si nécessaire
                break;
        }
    } else {
        // Gérer si des données sont manquantes dans $_POST
    }
}


function handleArticleForm($conn, $action) {
    // Vérifie si les données nécessaires sont présentes dans $_POST
    if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['lien'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $lien = $_POST['lien'];

        // Exécute l'action appropriée selon la valeur de $action
        switch($action) {
            case 'ajouter':
                addArticle($conn, $title, $description, $lien);
                break;
            case 'modifier':
                // Vérifie si l'ID de l'article est également présent dans $_POST
                if(isset($_POST['article_id'])) {
                    $article_id = $_POST['article_id'];
                    modifyArticle($conn, $article_id, $title, $description, $lien);
                } else {
                    // Gérer si l'ID de l'article est manquant
                }
                break;
            case 'supprimer':
                // Vérifie si l'ID de l'article est également présent dans $_POST
                if(isset($_POST['article_id'])) {
                    $article_id = $_POST['article_id'];
                    deleteArticleById($conn,  $currentID);
                } else {
                    // Gérer si l'ID de l'article est manquant
                }
                break;
            default:
                // Gérer d'autres actions si nécessaire
                break;
        }
    } else {
        // Gérer si des données sont manquantes dans $_POST
    }
}

function handlePublicationForm($conn, $action) {
    // Vérifie si les données nécessaires sont présentes dans $_POST
    if(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['lien'])) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $lien = $_POST['lien'];

        // Exécute l'action appropriée selon la valeur de $action
        switch($action) {
            case 'ajouter':
                addPublication($conn, $titre, $description, $lien);
                break;
            case 'modifier':
                // Vérifie si l'ID de la publication est également présent dans $_POST
                if(isset($_POST['publication_id'])) {
                    $publication_id = $_POST['publication_id'];
                    modifyPublication($conn, $publication_id, $titre, $description, $lien);
                } else {
                    // Gérer si l'ID de la publication est manquant
                }
                break;
            case 'supprimer':
                // Vérifie si l'ID de la publication est également présent dans $_POST
                if(isset($_POST['publication_id'])) {
                    $publication_id = $_POST['publication_id'];
                    deletePublication($conn, $publication_id);
                } else {
                    // Gérer si l'ID de la publication est manquant
                }
                break;
            default:
                // Gérer d'autres actions si nécessaire
                break;
        }
    } else {
        // Gérer si des données sont manquantes dans $_POST
    }
}

function handleFaqFormationForm($conn, $action) {
    // Vérifie si les données nécessaires sont présentes dans $_POST
    if(isset($_POST['question']) && isset($_POST['reponse'])) {
        $question = $_POST['question'];
        $reponse = $_POST['reponse'];

        // Exécute l'action appropriée selon la valeur de $action
        switch($action) {
            case 'ajouter':
                addFaqFormation($conn, $question, $reponse);
                break;
            case 'modifier':
                // Vérifie si l'ID de la FAQ formation est également présent dans $_POST
                if(isset($_POST['faq_formation_id'])) {
                    $faq_formation_id = $_POST['faq_formation_id'];
                    modifyFaqFormation($conn, $faq_formation_id, $question, $reponse);
                } else {
                    // Gérer si l'ID de la FAQ formation est manquant
                }
                break;
            case 'supprimer':
                // Vérifie si l'ID de la FAQ formation est également présent dans $_POST
                if(isset($_POST['faq_formation_id'])) {
                    $faq_formation_id = $_POST['faq_formation_id'];
                    deleteFaqFormation($conn, $faq_formation_id);
                } else {
                    // Gérer si l'ID de la FAQ formation est manquant
                }
                break;
            default:
                // Gérer d'autres actions si nécessaire
                break;
        }
    } else {
        // Gérer si des données sont manquantes dans $_POST
    }
}




?>
