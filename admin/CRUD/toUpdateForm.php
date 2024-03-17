<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';
require_once dirname(__DIR__, 2) . '/function/publications.fn.php';
$conn = getPDOlink($config);
$question = findQuestionById($conn, $_GET['id']); 
$article = findArticleById($conn, $_GET['id']);
$publication = findPublicationById($conn, $_GET['id']);


// Vérifiez si le type est passé dans l'URL
if(isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    // Redirection en cas d'absence du type
    // header("Location: ../dashboard.php");
    var_dump($type);
    exit;
}
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
<?php if($type === 'question') {?>
    <form action="update.php" method="post">
    <input type="hidden" name="type" value="question">
        <input type="hidden" name="id" value="<?= isset($question['id']) ? $question['id'] : '' ?>">
        <ul>
            <li>
                <label for="ask">Question : </label>
                <textarea id="ask" name="question" ><?= isset($question['question']) ? $question['question'] : '' ?></textarea>
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
<?php } elseif ($type === 'article') { ?>
    <form action="update.php" method="post">
    <input type="hidden" name="type" value="article">
        <input type="hidden" name="id" value="<?= isset($article['id']) ? $article['id'] : '' ?>">
        <ul>
            <li>
                <label for="title">Titre : </label>
                <textarea id="title" name="title"><?= isset($article['title']) ? $article['title'] : '' ?></textarea>
            </li>
            <li>
                <label for="origine">Lien : </label>
                <textarea id="origine" name="origine"><?= isset($article['origine']) ? $article['origine'] : '' ?></textarea>
            </li>
            <li>
                <label for="deskription">Description: </label>
                <textarea id="deskription" name="deskription"><?= isset($article['deskription']) ? $article['deskription'] : '' ?></textarea>
            </li>
            <li>
            <div class="button">
                <button type="submit">Valider les modifications</button>
            </div>
            </li>
        </ul>
    </form>
<?php } elseif ($type === 'publication') { ?>
    <form action="update.php" method="post">
    <input type="hidden" name="type" value="publication">
        <input type="hidden" name="id" value="<?= isset($publication['id']) ? $publication['id'] : '' ?>">
        <ul>
            <li>
                <label for="titre">Titre : </label>
                <textarea id="titre" name="titre"><?= isset($publication['titre']) ? $publication['titre'] : '' ?></textarea>
            </li>
            <li>
                <label for="description">Description: </label>
                <textarea id="description" name="description"><?= isset($publication['description']) ? $publication['description'] : '' ?></textarea>
            </li>
            <li>
                <label for="source">Source : </label>
                <textarea id="source" name="source"><?= isset($publication['source']) ? $publication['source'] : '' ?></textarea>
            </li>
            <li>
                <label for="lien">Lien : </label>
                <textarea id="lien" name="lien"><?= isset($publication['lien']) ? $publication['lien'] : '' ?></textarea>
            </li>
            <li>
            <div class="button">
                <button type="submit">Valider les modifications</button>
            </div>
            </li>
        </ul>
    </form>
    <?php } else {
            //   header("Location: ../dashboard.php");
            var_dump($type);
            exit;
        } ?>
    
    </div>

</body>
</html>
