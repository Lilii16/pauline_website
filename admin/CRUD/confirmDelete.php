<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
$conn = getPDOlink($config);
$currentId = $_POST['id'];
?>


<?php
// Vérification du type avant de confirmer la suppression
// Rajouter un type avec 'publication' ?
if (isset($_POST['type']) && ($_POST['type'] === 'question' || $_POST['type'] === 'article' || $_POST['type'] === 'publication' || $_POST['type'] === 'faq_formation')) {
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Confirmation de suppression</title>
</head>

<body>
    <div class="row justify-content-center align-items-center">
        <h1>Etes-vous sûr de vouloir supprimer cet élément ?</h1>
    <form action="deletedElement.php" method="post" class="row justify-content-center col-6">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="type" value="<?php echo $type; ?>">
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
    <a href="dashboard.php" class="btn btn-warning">Ne pas supprimer</a>
    </div>

</body>

</html>