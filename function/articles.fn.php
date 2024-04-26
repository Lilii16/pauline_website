<?php
// require_once 'database.fn.php';

// Établir la connexion à la base de données
// $conn = getPDOlink($config);

//création fonction qui permet de récupérer les articles de la bdd pour la page ressources
function findAllArticles($conn){
    $sql= "SELECT * FROM `articles`";
    $requete = $conn->query($sql);
    $articles = $requete->fetchAll();
    return $articles;
}

//pour visualiser le contenu du tableau qui est récupéré (attention echo ne pourra pas afficher le tableau)


// cette fonction nous permet de regarder un seul artcile séléctionnée grâce à son id
function findArticleById($conn, $currentID) {
    try {
        // Préparation de la requête SQL pour sélectionner l'article avec l'ID spécifié
        $sql = "SELECT id, title, deskription, origine FROM articles WHERE id = :id";
        
        // Préparation de la requête
        $stmt = $conn->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $currentID, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Récupération de l'article
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Retourne l'article
        return $article;
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}

function deleteArticleById($conn, $currentID) {
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

function updateArticle($conn, $currentId)
{
    try {
        // Stocker les données actuelles avant la mise à jour
        $currentData = findArticleById($conn, $currentId);
        $currentDate = date('Y-m-d');

        // Stocker les données actuelles avant la mise à jour
        $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
        $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
        $origine = isset($_POST['origine']) ? htmlspecialchars($_POST['origine']) : '';

        // Préparer les valeurs à mettre à jour
        $updateValues = array();
        $params = array();

        // Vérifier chaque champ s'il a changé
        if ($title != $currentData['title']) {
            $updateValues[] = "title = ?";
            $params[] = $title;
        }
        if ($description != $currentData['deskription']) {
            $updateValues[] = "deskription = ?";
            $params[] = $description;
        }
        if ($origine != $currentData['origine']) {
            $updateValues[] = "origine = ?";
            $params[] = $origine;
        }

        // S'il y a des valeurs à mettre à jour, exécuter la requête SQL
        if (!empty($updateValues)) {
            $updateValues[] = "last_modified_date = ?";
            $params[] = $currentDate;

            // Construire la requête SQL avec des déclarations préparées
            $updateString = implode(', ', $updateValues);
            $sql = "UPDATE articles SET $updateString WHERE id = ?";
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
