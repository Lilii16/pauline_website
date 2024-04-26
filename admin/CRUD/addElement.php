<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/database.fn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';
require_once dirname(__DIR__, 2) . '/function/publications.fn.php';


// Récupération de la connexion PDO
$conn = getPDOlink($config);


// Vérification du type avant de récupérer les données du formulaire
if (isset($_POST['type']) && ($_POST['type'] === 'question' || $_POST['type'] === 'article' || $_POST['type'] === 'publication' || $_POST['type'] === 'faq_formation')) {
    $type = $_POST['type'];
} else {
    // Redirection en cas de type non valide (vers une page erreur qi rederige ensuite vers dashboard)
    header("Location: ../dashboard.php");
    exit();
}

$currentDate = date('Y-m-d');

//récupérer les données rentrées dans le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($type) {
        case 'question':
            $question = htmlspecialchars($_POST['question']);
            $reponse = htmlspecialchars($_POST['reponse']);
            try {
                $sql = "INSERT INTO `questions` (`question`, `reponse`, `last_modified_date`) VALUES (:question, :reponse, :currentDate)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':question', $question);
                $stmt->bindParam(':reponse', $reponse);
                $stmt->bindParam(':currentDate',  $currentDate);
                $stmt->execute();
                $stmt->closeCursor();
                session_start();
                $_SESSION['success_message'] = "$type a été ajouté avec succès.";
                header("Location: ../dashboard.php");
                exit;
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            break;
        case 'article':
            $title = htmlspecialchars($_POST['title']);
            $origine = htmlspecialchars($_POST['origine']);
            $description = htmlspecialchars($_POST['description']);
            try {
                $sql = "INSERT INTO `articles` (`title`, `origine`, `deskription`, `last_modified_date`) VALUES ('$title', '$origine', '$description', '$currentDate')";
                $conn->query($sql);
                session_start();
                $_SESSION['success_message'] = "$type a été ajouté avec succès.";
                header("Location: ../dashboard.php");
                exit;
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            break;
        case 'publication':
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $source = htmlspecialchars($_POST['source']);
            $lien = htmlspecialchars($_POST['path']);
            try {
                $sql = "INSERT INTO `publications` (`titre`, `description`, `source`, `path`, `last_modified_date`) VALUES ('$titre', '$description', '$source', '$lien','$currentDate')";
                $conn->query($sql);
                session_start();
                $_SESSION['success_message'] = "$type a été ajouté avec succès.";
                header("Location: ../dashboard.php");
                exit;
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            break;
        case 'faq_formation':
            $question = htmlspecialchars($_POST['question']);
            $reponse = htmlspecialchars($_POST['reponse']);
            try {
                $sql = "INSERT INTO `faq-formation` (`question`, `reponse`,`last_modified_date`) VALUES ('$question', '$reponse','$currentDate')";
                $conn->query($sql);
                session_start();
                $_SESSION['success_message'] = "$type a été ajouté avec succès.";
                header("Location: ../dashboard.php");
                exit;
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            break;
        default:
            // Redirection en cas de type invalide
            header("Location: ../dashboard.php");
            exit;
    }
} else {
    // Redirection si le formulaire n'a pas été soumis via POST
    header("Location: ../dashboard.php");
    exit;
}
?>
