
<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion du Droit à la santé mentale</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h2>Ajouter une question</h2>
            <form action="addQuestion.php" method="post" class="d-flex flex-column justify-content-center align-items-center"><br>
                <label for="question">Question : </label>
                <input type="text" name="question"><br>
                <label for="reponse">Réponse : </label>
                <textarea name="reponse" style="height: 100px"></textarea><br>
                <input type="submit" value="Ajouter"><br>
            </form>
        </div>
        
</body>
</html>
