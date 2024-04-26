<?php 
// require_once 'database.fn.php';

// Établir la connexion à la base de données
//    $conn = getPDOlink($config);

//création fonction qui permet de récupérer les questions de la bdd pour la page ressouce

function findAllPublications($conn){
    $sql= "SELECT * FROM `publications`";
    $requete = $conn->query($sql);
    $publications = $requete->fetchAll();
    return $publications;
}

//pour visualiser le contenu du tableau qui est récupéré (attention echo ne pourra pas afficher le tableau)
// var_dump(findAllRessources($conn));

// cette fonction nous permet de regarder un seul artcile séléctionnée grâce à son id
function findPublicationById($conn, $currentID) {
    try {
        // Préparation de la requête SQL pour sélectionner l'article avec l'ID spécifié
        $sql = "SELECT id, titre, `description`, source, `path` FROM publications WHERE id = :id";
        
        // Préparation de la requête
        $stmt = $conn->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $currentID, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Récupération de l'article
        $publication = $stmt->fetch(PDO::FETCH_ASSOC);


        
        // Retourne l'article
        return $publication;
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}


// dowload 


// Cette fonction permet de télécharger un fichier à partir de la base de données en utilisant son ID
// Cette fonction permet de télécharger le fichier d'une publication à partir de la base de données en utilisant son ID
function downloadPublicationById($conn, $publicationID) {
    try {
        // Récupérer les informations de la publication
        $publication = findPublicationById($conn, $publicationID);

        // Vérifier si la publication existe
        if ($publication) {
           // Définir les en-têtes pour le téléchargement
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf'); // Modifier le type MIME selon le type de fichier (PDF ici)
    header('Content-Disposition: attachment; filename="' . $publication['titre'] . '"');

    // Lire le contenu du fichier PDF et l'envoyer au navigateur
    // readfile($publication['path']);
        } else {
            // Si la publication n'existe pas, afficher un message d'erreur
            echo "La publication n'existe pas.";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur: " . $e->getMessage();
    }
}



function deletePublicationById($conn, $currentID) {
    try {
        // Préparation de la requête SQL pour supprimer l'élément avec l'ID spécifié
        $sql = "DELETE FROM articles WHERE id = :id";
        
        // Préparation de la requête
        $stmt = $conn->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $currentID, PDO::PARAM_INT);
        
        // Exécution de la requête
        if ($stmt->execute()) {
            // La suppression a réussi
            return true;
        } else {
            // La suppression a échoué
            return false;
        }
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}

function updatePublication($conn, $currentId)
{
    try {
        // Stocker les données actuelles avant la mise à jour
        $currentData = findPublicationById($conn, $currentId);

        // Récupérer les valeurs du formulaire
        $titre = isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : '';
        $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
        $source = isset($_POST['source']) ? htmlspecialchars($_POST['source']) : '';
        $lien = isset($_POST['lien']) ? htmlspecialchars($_POST['lien']) : '';

        // Préparer les valeurs à mettre à jour
        $updateValues = array();
        $params = array();

        // Vérifier chaque champ s'il a changé
        if ($titre != $currentData['titre']) {
            $updateValues[] = "titre = ?";
            $params[] = $titre;
        }
        if ($description != $currentData['description']) {
            $updateValues[] = "description = ?";
            $params[] = $description;
        }
        if ($source != $currentData['source']) {
            $updateValues[] = "source = ?";
            $params[] = $source;
        }
        if ($lien != $currentData['path']) {
            $updateValues[] = "lien = ?";
            $params[] = $lien;
        }

        // S'il y a des valeurs à mettre à jour, exécuter la requête SQL
        if (!empty($updateValues)) {
            $currentDate = date('Y-m-d');
            $updateValues[] = "last_modified_date = ?";
            $params[] = $currentDate;

            // Construire la requête SQL avec des déclarations préparées
            $updateString = implode(', ', $updateValues);
            $sql = "UPDATE publications SET $updateString WHERE id = ?";
            $stmt = $conn->prepare($sql);

            // Binder les paramètres
            foreach ($params as $index => $param) {
                $stmt->bindValue($index + 1, $param);
            }
            $stmt->bindValue(count($params) + 1, $currentId);

            // Exécuter la requête
            $stmt->execute();
        }

        // Retourner true pour indiquer que la mise à jour s'est déroulée avec succès
        return true;
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Error: " . $e->getMessage();
        return false;
    }
}
