<?php 
//  $conn = getPDOlink($config); 
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';

//récupérer les données rentrées dans le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    } catch (PDOException $e) {
        $conn->rollback();
        //annuler tous les changements de la transaction en cours
        echo "erreur : " . $e->getMessage();
    }

}

?>