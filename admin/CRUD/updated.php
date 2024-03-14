<?php 
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/database.fn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';

// $item = $_POST['id'];
// $name = $_POST['name'];
// $description = $_POST['description'];
// $price = $_POST['price'];
// $capacity = $_POST['ml'];
$updatedData = $_POST; // les données envoyées lors de la modification
$currentId = $_POST['id'];
$currentData = findQuestionById($conn, $currentId); // la fonction qui récupère les données 
// actuelles de la base de données
$diff = array_diff_assoc($updatedData, $currentData); 

var_dump($updatedData);
var_dump($currentData);
var_dump($diff);
// la prochaine étape sera de faire un UPDATE sur les tables SQL items_cards, pictures et 
// capacities

// $sql = "UPDATE items_cards SET price WHERE id"; 
// for each catégorie du tableau $differences, je veux que tu 

// Récupération des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentId = $_POST['id'];
    $question = $_POST['question'];
    $reponse = $_POST['reponse'];

    try {
        // Récupération des données actuelles de la question
        $currentData = findQuestionById($conn, $currentId); // Supposant que vous avez une fonction pour récupérer les données actuelles

        // Comparaison des données actuelles avec les nouvelles données
        $updatedData = [
            'question' => $question,
            'reponse' => $reponse
        ];

        $diff = array_diff_assoc($updatedData, $currentData);

        // Construction de la requête SQL en fonction des données modifiées
        $sql = "UPDATE questions SET ";
        $updates = [];

        foreach ($diff as $key => $value) {
            $updates[] = "$key = '$value'";
        }

        $sql .= implode(", ", $updates);
        $sql .= " WHERE id = '$currentId'";

        // Exécution de la requête SQL si des changements ont été détectés
        if (!empty($diff)) {
            $conn->exec($sql);
            echo "Question mise à jour avec succès.";
        } else {
            echo "Aucune modification détectée.";
        }

        // Redirection après un court délai
        header("Refresh: 5; url=/admin/dashboard.php");
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la mise à jour de la question: " . $e->getMessage();
    }
}
//songer à rajouter la sécurité
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form action="dashboard.php" method="get">
    <button type="submit" class="btn btn-green">Revenir au dashboard</button>
</form>
    
</body>
</html>