<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';
require_once dirname(__DIR__, 2) . '/function/publications.fn.php';
require_once dirname(__DIR__, 2) . '/function/faq_formations.fn.php';

// Récupérer les données extérieures
$currentId = $_POST['id'];
$type = $_POST['type'];
$currentDate = date('Y-m-d');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    if ($type === 'question') {
        try {
            // Stocker les données actuelles avant la mise à jour
            $question = htmlspecialchars($_POST['question']);
            $reponse = htmlspecialchars($_POST['reponse']);
            $currentData = findQuestionById($conn, $currentId);
            $oldData = $currentData;
            // La date actuelle
        

            // Préparer les valeurs à mettre à jour
            $updateValues = array();

            // Vérifier chaque champ s'il a changé
            if ($question != $oldData['question']) {
                $updateValues[] = "question = '$question'";
            }
            if ($reponse != $oldData['reponse']) {
                $updateValues[] = "reponse = '$reponse'";
            }

            // S'il y a des valeurs à mettre à jour, exécuter la requête SQL
            if (!empty($updateValues)) {
                //transformation de tableau en string pour envoyer dans la requete sql
                // implode(string $separator, array $array): string
                      // Ajoutez la date de dernière modification à la liste des valeurs à mettre à jour
                      $updateValues[] = "last_modified_date = '$currentDate'";
                $updateString = implode(', ', $updateValues);
                $sql = "UPDATE questions SET $updateString WHERE id = '$currentId'";
                $conn->query($sql);
            }

            session_start();
            // Message de réussite
          $success_message = "$type modifié avec succès";
    
            // Après avoir réalisé avec succès l'action de suppression
            $_SESSION['success_message'] = "$type a été modifié avec succès.";
            // Redirection après un court délai
            header("Location: ../dashboard.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } elseif ($type === 'article') {
        $title = htmlspecialchars($_POST['title']);
        $origine = htmlspecialchars($_POST['origine']);
        $deskription = htmlspecialchars($_POST['deskription']);
        $currentData = findArticleById($conn, $currentId);
        $oldData = $currentData;
        try {
            // Préparer les valeurs à mettre à jour
            $updateValues = array();

            // Vérifier chaque champ s'il a changé
            if ($title != $oldData['title']) {
                $updateValues[] = "title = '$title'";
            }
            if ($origine != $oldData['origine']) {
                $updateValues[] = "origine = '$origine'";
            }
            if ($deskription != $oldData['deskription']) {
                $updateValues[] = "deskription = '$deskription'";
            }

            // S'il y a des valeurs à mettre à jour, exécuter la requête SQL
            if (!empty($updateValues)) {
                $updateString = implode(', ', $updateValues);
                $sql = "UPDATE articles SET $updateString WHERE id = '$currentId'";
                $conn->query($sql);
            }

            session_start();
            // Message de réussite
          $success_message = "$type modifié avec succès";
    
            // Après avoir réalisé avec succès l'action de suppression
            $_SESSION['success_message'] = "$type a été modifié avec succès.";
            // Redirection après un court délai
            header("Location: ../dashboard.php");
          
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } elseif ($type === 'publication') {
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $source = htmlspecialchars($_POST['source']);
        $lien = htmlspecialchars($_POST['lien']);
        $currentData = findPublicationById($conn, $currentId);
        $oldData = $currentData;
        try {
            // Préparer les valeurs à mettre à jour
            $updateValues = array();

            // Vérifier chaque champ s'il a changé
            if ($titre != $oldData['titre']) {
                $updateValues[] = "titre = '$titre'";
            }
            if ($description != $oldData['description']) {
                $updateValues[] = "description = '$description'";
            }
            if ($source != $oldData['source']) {
                $updateValues[] = "source = '$source'";
            }
            if ($lien != $oldData['path']) {
                $updateValues[] = "lien = '$lien'";
            }

            // S'il y a des valeurs à mettre à jour, exécuter la requête SQL
            if (!empty($updateValues)) {
                $updateString = implode(', ', $updateValues);
                $sql = "UPDATE publications SET $updateString WHERE id = '$currentId'";
                $conn->query($sql);
            }

            session_start();
            // Message de réussite
          $success_message = "$type publication avec succès";
    
            // Après avoir réalisé avec succès l'action de suppression
            $_SESSION['success_message'] = "$type a été publication avec succès.";
            // Redirection après un court délai
            header("Location: ../dashboard.php");

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else if ($type === 'faq_formation') {
        try {
            // Stocker les données actuelles avant la mise à jour
            $question = htmlspecialchars($_POST['question']);
            $reponse = htmlspecialchars($_POST['reponse']);
            $currentData = findAllQuestionsFormationById($conn, $currentId);
            $oldData = $currentData;

            // Préparer les valeurs à mettre à jour
            $updateValues = array();

            // Vérifier chaque champ s'il a changé
            if ($question != $oldData['question']) {
                $updateValues[] = "question = '$question'";
            }
            if ($reponse != $oldData['reponse']) {
                $updateValues[] = "reponse = '$reponse'";
            }

            // S'il y a des valeurs à mettre à jour, exécuter la requête SQL
            if (!empty($updateValues)) {
                //transformation de tableau en string pour envoyer dans la requete sql
                // implode(string $separator, array $array): string
                $updateString = implode(', ', $updateValues);
                $sql = "UPDATE `faq-formation` SET $updateString WHERE id = '$currentId'";
                $conn->query($sql);
            }


            session_start();
            // Message de réussite
          $success_message = "$type modifié avec succès";
    
            // Après avoir réalisé avec succès l'action de suppression
            $_SESSION['success_message'] = "$type a été modifié avec succès.";
            // Redirection après un court délai
            header("Location: ../dashboard.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Redirection en cas de type invalide

        exit;
    }
}
