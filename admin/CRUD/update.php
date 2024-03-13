<?php 
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';

// Récupérer les données extérieures
$currentId = $_POST['id'];
$currentData = findQuestionById($conn, $currentId); // Assurez-vous d'avoir une fonction de ce type pour récupérer les données actuelles

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);

    try {
        // Stocker les données actuelles avant la mise à jour
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
            $updateString = implode(', ', $updateValues);
            $sql = "UPDATE questions SET $updateString WHERE id = '$currentId'";
            $conn->query($sql);
        }

        // Message de réussite
        echo "Question updated successfully";

        // Redirection après un court délai
        header("Refresh: 3; url=/admin/dashboard.php");
    } catch (PDOException $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
