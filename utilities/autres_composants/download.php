<?php
require_once('/config/conn.php');

// Inclure le fichier de connexion à la base de données et la définition des fonctions
  require_once dirname(__DIR__, 2) . '/function/publications.fn.php';

// Vérifier si l'ID de la publication est spécifié dans l'URL
if(isset($_GET['id'])) {
    // Récupérer l'ID de la publication depuis l'URL
    $CurrentID = $_GET['id'];

    // Télécharger le fichier PDF de la publication
    downloadPublicationById($conn, $CurrentID);
} else {
    // Si l'ID de la publication n'est pas spécifié, afficher un message d'erreur
    echo "L'ID de la publication n'est pas spécifié.";
}
?>
