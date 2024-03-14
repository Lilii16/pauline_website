<?php 
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';

// Récupérer les données extérieures
$currentId = $_POST['id'];
$type = $_POST['type'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
        if ($type === 'question') {
            try {
               // Stocker les données actuelles avant la mise à jour
               $question = htmlspecialchars($_POST['question']);
               $reponse = htmlspecialchars($_POST['reponse']);
               $currentData = findQuestionById($conn, $currentId); 
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
                   $sql = "UPDATE questions SET $updateString WHERE id = '$currentId'";
                   $conn->query($sql);
               }

            
               // Message de réussite
               echo "Question updated successfully";
       
               // Redirection après un court délai
               header("Refresh: 3; url=/admin/dashboard.php");
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    } elseif ($type === 'article') {
        $titre = htmlspecialchars($_POST['title']);
        $lien = htmlspecialchars($_POST['origine']);
        $description = htmlspecialchars($_POST['deskription']);
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
     
             // Message de réussite
             echo "Article modifié avec succes";
     
             // Redirection après un court délai
             header("Refresh: 3; url=/admin/dashboard.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Redirection en cas de type invalide
     
        exit;
    }
}
?>
