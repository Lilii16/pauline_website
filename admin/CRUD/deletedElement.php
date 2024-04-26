<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once '../../function/database.fn.php';

// Récupération de la connexion PDO
$conn = getPDOlink($config);

// Vérification de la présence des données dans la requête POST
if(isset($_POST['id']) && isset($_POST['type'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    
    // Préparation de la requête en fonction du type d'élément à supprimer
    switch ($type) {
        case 'article':
            $table = 'articles';
            break;
        case 'question':
            $table = 'questions';
            break;
        case 'publication':
            $table = 'publications';
            break;
        case 'faq_formation':
            $table = 'faq_formation';
            break;
        default:
            // Gérer le cas où le type n'est pas reconnu
            echo "Type d'élément non valide.";
            exit();
    }
    
    // Sécurisation de la requête avec une préparation PDO
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    
    // Exécution de la requête avec l'ID correspondant
    $stmt->execute([$id]);
    
    // Message de réussite
    session_start();
    $success_message = "$type supprimé avec succès";
    $_SESSION['success_message'] = "$type a été supprimé avec succès.";
    
    header("Location: ../dashboard.php?section=" . $type . "Content");

exit; // Assure que le script s'arrête ici pour éviter toute exécution supplémentaire

} else {
    // Gérer le cas où l'ID ou le type n'est pas défini
    echo "ID ou type non défini.";
    exit();
}
?>
