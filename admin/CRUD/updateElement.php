<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/database.fn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';
require_once dirname(__DIR__, 2) . '/function/publications.fn.php';
require_once dirname(__DIR__, 2) . '/function/faq_formations.fn.php';


// Récupération de la connexion PDO
$conn = getPDOlink($config);

// Récupérer les données extérieures
$currentId = $_POST['id'];
$type = $_POST['type'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($type) {
        case 'question':
            try {

                updateQuestion($conn, $currentId);
                session_start();
                // Message de réussite
                $success_message = "$type modifié avec succès";
                $_SESSION['success_message'] = "$type a été modifié avec succès.";

                // Redirection après un court délai
                header("Location: ../dashboard.php");
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            break;
        case 'article':

            try {
                updateArticle($conn, $currentId);
                session_start();
                // Message de réussite
                $success_message = "$type modifié avec succès";
                $_SESSION['success_message'] = "$type a été modifié avec succès.";


                // Redirection vers la page avec le paramètre de section spécifié
                header("Location: ../dashboard.php?section=articleContent");
                exit; // Assure que le script s'arrête ici pour éviter toute exécution supplémentaire


            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            break;
        case 'publication':
            try {
                updatePublication($conn, $currentId);
                session_start();
                // Message de réussite
                $success_message = "$type modifié avec succès";
                $_SESSION['success_message'] = "$type a été modifié avec succès.";

                // Redirection vers la page avec le paramètre de section spécifié
                header("Location: ../dashboard.php?section=publicationContent");
                exit; // Assure que le script s'arrête ici pour éviter toute exécution supplémentaire

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            break;
        case 'faq_formation':
            try {
                updateQuestionsFormation($conn,$currentId);

                session_start();
                // Message de réussite
                $success_message = "$type modifié avec succès";
                $_SESSION['success_message'] = "$type a été modifié avec succès.";
                // Redirection vers la page avec le paramètre de section spécifié
                header("Location: ../dashboard.php?section=faq_formationContent");
                exit; // Assure que le script s'arrête ici pour éviter toute exécution supplémentaire

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            break;
        default:
            // Redirection en cas de type invalide
            exit;
    }
}
