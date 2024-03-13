<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
$conn = getPDOlink($config);
$question = findQuestionById($conn, $_GET['id']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de modification des questions</title>
</head>

<body>
    <div class="card decoration-none">
    <form action="updated.php" method="post">
        <input type="hidden" name="id" value="<?= isset($question['id']) ? $question['id'] : '' ?>">
        <ul>
            <li>
                <label for="ask">Question : </label>
                <textarea id="ask" name="question"><?= isset($question['question']) ? $question['question'] : '' ?></textarea>
            </li>
            <li>
                <label for="msg">Réponse : </label>
                <textarea id="msg" name="reponse"><?= isset($question['reponse']) ? $question['reponse'] : '' ?></textarea>
            </li>
            <li>
            <div class="button">
                <button type="submit">Valider les modifications</button>
            </div>
            </li>
        </ul>
    </form>
    
    </div>

</body>
</html>
