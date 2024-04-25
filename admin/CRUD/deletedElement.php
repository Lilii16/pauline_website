<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once '../../function/database.fn.php';

//recupérer 
  $conn = getPDOlink($config); 
  $type = $_POST['type'];
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
      } elseif($_POST['type'] === 'publication') {
        // Supprimer la question avec l'ID correspondant
        $stmt = $conn->prepare("DELETE FROM publications WHERE id = ?");
        $stmt->execute([$_POST['id']]);
      } elseif($_POST['type'] === 'faq_formation') {
        // Supprimer la question avec l'ID correspondant
        $stmt = $conn->prepare("DELETE FROM `faq-formation` WHERE id = ?");
        $stmt->execute([$_POST['id']]);
      } else {
          // Gérer le cas où le type n'est pas reconnu
          echo "Type d'élément non valide.";
          exit();
      }
  
        // Message de réussite
        // echo "$type supprimée avec succès";
        
        session_start();
        // Message de réussite
      $success_message = "$type supprimé avec succès";

        // Après avoir réalisé avec succès l'action de suppression
        $_SESSION['success_message'] = "$type a été supprimé avec succès.";
        
   
        // Redirection après un court délai
        header("Location:../dashboard.php");
      exit();
  } else {
      // Gérer le cas où l'ID ou le type n'est pas défini
      echo "ID ou type non défini.";
      exit();
  }
  ?>