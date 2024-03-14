<?php 
//  $conn = getPDOlink($config); 
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';

// Vérification du type avant de récupérer les données du formulaire
if (isset($_POST['type']) && ($_POST['type'] === 'question' || $_POST['type'] === 'article')) {
    $type = $_POST['type'];
} else {
    // Redirection en cas de type non valide (vers une page erreur qi rederige ensuite vers dashboard)
    header("Location: ../dashboard.php");
    exit();
}

//récupérer les données rentrées dans le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($type === 'question') {
        $question = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);
   
// var_dump($_POST);
    try {
        $sql = "INSERT INTO `questions` (`question`, `reponse`) VALUES ('$question', '$reponse')";
        $conn->query($sql);
       
        // Message de réussite
        echo "Question ajouté avec succès";

        // Redirection après un court délai
        header("Refresh: 3; url=/admin/dashboard.php");
        exit; // Sortir du script après la redirection
    } catch (PDOException $e) {
        //annuler tous les changements de la transaction en cours
        echo "Erreur : " . $e->getMessage();
    }
} elseif ($type === 'article') {
    $title = htmlspecialchars($_POST['title']);
    $origine = htmlspecialchars($_POST['origine']);
    $deskription = htmlspecialchars($_POST['deskription']);

    try {
        $sql = "INSERT INTO `articles` (`title`, `origine`, `deskription`) VALUES ('$title', '$origine', '$deskription')";
        $conn->query($sql);
       
        // Message de réussite
        echo "
        <h1> Article ajouté avec succès</h1>
    ";

        // Redirection après un court délai
        header("Refresh: 3; url=/admin/dashboard.php");
        exit; // Sortir du script après la redirection
    } catch (PDOException $e) {
        //annuler tous les changements de la transaction en cours
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Redirection en cas de type invalide
    header("Location: ../dashborard.php");
    exit;
}
} else {
// Redirection si le formulaire n'a pas été soumis via POST
header("Location: ../dashborard.php");
exit;
}
?>

