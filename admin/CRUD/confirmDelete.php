<?php
require_once dirname(__DIR__, 2) . '/config/conn.php'; 
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
$conn = getPDOlink($config);
$currentId = $_POST['id'];
// $question = findQuestionById($conn,$currentId);
?>


<?php
// Vérification du type avant de confirmer la suppression
// Rajouter un type avec 'publication' ?
if(isset($_POST['type']) && ($_POST['type'] === 'question' || $_POST['type'] === 'article' || $_POST['type'] === 'publication')) {
    $id = $_POST['id'];
    $type = $_POST['type'];
} else {
    // Redirection en cas de type non valide
    header("Location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de suppression</title>
</head>
<body>
    <h1>Etes-vous sûr de vouloir supprimer cet élément ?</h1>
    <form action="deleted.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="type" value="<?php echo $type; ?>">
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
    <a href="dashboard.php" class="btn btn-warning">Ne pas supprimer</a>
</body>
</html>
