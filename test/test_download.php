<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Télécharger PDF</title>
</head>
<body>
    <h1>Télécharger PDF</h1>
    <!-- Bouton pour télécharger le PDF -->
    <form action="telecharger_pdf.php" method="post">
        <button type="submit">Télécharger PDF</button>
    </form>
</body>
</html>


<?php
// Chemin vers le fichier PDF à télécharger
$chemin_du_document = './assets/publications_perso/Bread_and_Shoulders.pdf';

// Vérifier si le fichier existe
if (file_exists($chemin_du_document)) {
    // Nom du fichier pour le téléchargement
    $nom_fichier = basename($chemin_du_document);

    // Type MIME du fichier (PDF)
    $type_mime = 'application/pdf';

    // Envoi des en-têtes HTTP pour forcer le téléchargement
    header('Content-Type: ' . $type_mime);
    header('Content-Disposition: attachment; filename="' . $nom_fichier . '"');
    header('Content-Length: ' . filesize($chemin_du_document));

    // Lire le fichier et l'envoyer au navigateur
    readfile($chemin_du_document);
    exit;
} else {
    // Si le fichier n'existe pas, afficher un message d'erreur
    echo "Le fichier n'existe pas.";
}
?>
