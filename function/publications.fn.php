<?php 
// require_once 'database.fn.php';

// Établir la connexion à la base de données
//    $conn = getPDOlink($config);

//création fonction qui permet de récupérer les titles de la bdd pour la page ressouce

// function findAllPublications($conn){
//     $sql= "SELECT * FROM `publications`";
//     $requete = $conn->query($sql);
//     $publications = $requete->fetchAll();
//     return $publications;
// }



function findAllPublications($conn, $tri = '') {
    $sql = "SELECT * FROM `publications`";
    

// crée une fonction generale plus tard attention
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de la valeur sélectionnée dans le formulaire
    $tri = $_POST["tri"];
}
   // Ajout du tri si un critère de tri est spécifié
   if ($tri == 'last_modified_date') {
    $sql .= " ORDER BY last_modified_date DESC";
} elseif ($tri == 'title') {
    $sql .= " ORDER BY title ASC";
}
    $requete = $conn->query($sql);
    $publications = $requete->fetchAll();
    return $publications;
}

function findAllPublicationsPagination($conn, $tri, $items_per_page, $offset) {
    $sql = "SELECT * FROM `publications`";

    // Ajout du tri si un critère de tri est spécifié
    if ($tri == 'last_modified_date') {
        $sql .= " ORDER BY last_modified_date DESC";
    } elseif ($tri == 'title') {
        $sql .= " ORDER BY title ASC";
    }

    // Ajout de l'offset et du nombre d'éléments par page
    $sql .= " LIMIT $offset, $items_per_page";

    // Exécution de la requête SQL
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
        $lien = isset($_POST['new_path']) ? htmlspecialchars($_POST['new_path']) : '';

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

        // Vérifier si un nouveau fichier a été téléchargé
        if(isset($_FILES['new_path']) && $_FILES['new_path']['error'] == 0){
            $uploadfolder = '../../assets/publications_perso/';
            $uploadfile = $uploadfolder . basename($_FILES['new_path']['name']);
            $file_extension = strtolower(pathinfo($_FILES['new_path']['name'], PATHINFO_EXTENSION));
            
            // Vérification du type de fichier
            if ($file_extension != "pdf") {
                echo "Seuls les fichiers PDF sont autorisés.";
                exit;
            }
            
            // Vérification de la taille du fichier (max 10 Mo = 10 * 1024 * 1024 octets)
            $max_file_size = 10 * 1024 * 1024; // 10 Mo
            if ($_FILES['new_path']['size'] > $max_file_size) {
                echo "La taille du fichier dépasse la limite autorisée.";
                exit;
            }
            
            if (move_uploaded_file($_FILES['new_path']['tmp_name'], $uploadfile)) {
                // Succès du téléchargement
                $lien = $uploadfile;
            } else {
                // Échec du téléchargement
                echo "Erreur lors du téléchargement du fichier.";
                exit;
            }
        }

        // Vérifier si le fichier a été modifié
        if ($lien != $currentData['path']) {
            // ajouter au tableau de modifications sinon la requete ne s'envoie
            $updateValues[] = "path = ?";
            $params[] = $lien;

            // Supprimer l'ancien fichier PDF
            unlink($currentData['path']);
        }

        // S'il y a des valeurs à mettre à jour, exécuter la requête SQL
        if (!empty($updateValues)) {
            $currentDate = date('Y-m-d');
            $updateValues[] = "last_modified_date = ?";
            $params[] = $currentDate;

            // Construire la requête SQL avec des déclarations préparées
            $updateString = implode(', ', $updateValues);
            $sql = "UPDATE publications SET $updateString, path = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            // Binder les paramètres
            foreach ($params as $index => $param) {
                $stmt->bindValue($index + 1, $param);
            }
            $stmt->bindValue(count($params) + 1, $lien);
            $stmt->bindValue(count($params) + 2, $currentId);

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



function displayPublicationsWithPagination($conn, $tri, $items_per_page) {
    // Récupérer le numéro de page actuelle depuis l'URL, par défaut 1 si non spécifié
    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Récupérer le nombre total de publications
    $total_items = count(findAllPublications($conn, $tri));

    // Calculer l'index de départ pour la requête SQL en fonction de la page actuelle
    $offset = ($current_page - 1) * $items_per_page;

    // Récupérer les publications pour la page actuelle en utilisant l'offset
    $publications = findAllPublicationsPagination($conn, $tri, $items_per_page, $offset);

    // Afficher les publications
    foreach ($publications as $publication) {
        // Affichage de chaque publication
        echo '<tr>
                <td>' . $publication['titre'] . '</td>
                <td>' . $publication['last_modified_date'] . '</td>
                <td>
                    <button type="button" class="btn btn-light trigger-btn-view" data-toggle="modal" data-target="#myModal" data-action="afficher" data-type="publication" data-id="' . $publication['id'] . '" data-title="' . $publication['titre'] . '" data-description="' . $publication['description'] . '" data-lien="' . $publication['path']. '" data-source="' . $publication['source']  . '">Afficher</button>
                </td>
                <td>
                    <button type="button" class="btn btn-light trigger-btn-modify" data-toggle="modal" data-target="#myModal" data-action="modifier" data-type="publication" data-id="' . $publication['id'] . '" data-title="' . $publication['titre'] . '" data-description="' . $publication['description'] . '" data-lien="' . $publication['path'] . '" data-source="' . $publication['source'] . '">Modifier</button>
                </td>
                <td class="text-end">
                    <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-delete" data-toggle="modal" data-target="#myModal" data-action="supprimer" data-type="publication" data-id="' . $publication['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
            </tr>';
    }
    echo '</tbody>
        </table>';

   // Afficher la pagination
   $page_url = "?tri=$tri"; // Définir votre URL de page ici
   $section = "publicationContent"; // Mettez votre section ici si nécessaire
   echo pagination($total_items, $items_per_page, $current_page, $page_url, $section);
}
