<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';

//recupérer 
// $currentId = $_POST['id'];
// $delete = deleteQuestionById($conn, $currentId);
  $conn = getPDOlink($config); 
  $type = $_POST['type'];
  // deleted.php 
  // Vérifier si l'ID et le type sont définis dans la requête POST
  
  if(isset($_POST['id']) && isset($_POST['type'])) {
      
      // Suppression en fonction du type d'élément
      if($_POST['type'] === 'article') {
          // Supprimer l'article avec l'ID correspondant
          $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
          $stmt->execute([$_POST['id']]);
      } elseif($_POST['type'] === 'question') {
          // Supprimer la question avec l'ID correspondant
          $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
          $stmt->execute([$_POST['id']]);
      } else {
          // Gérer le cas où le type n'est pas reconnu
          echo "Type d'élément non valide.";
          exit();
      }
  
        // Message de réussite
        echo "$type supprimée avec succès";

        // Redirection après un court délai
        header("Refresh: 3; url=/admin/dashboard.php");
      exit();
  } else {
      // Gérer le cas où l'ID ou le type n'est pas défini
      echo "ID ou type non défini.";
      exit();
  }
  ?>