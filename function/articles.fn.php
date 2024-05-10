<?php

//création fonction qui permet de récupérer les articles de la bdd pour la page ressources
function  findAllArticles($conn, $tri = '') {
    $sql = "SELECT * FROM `articles`";
// crée une fonction generale plus tard attention
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de la valeur sélectionnée dans le formulaire
    $tri = $_POST["tri"];
}
   // Ajout du tri si un critère de tri est spécifié
   if ($tri == 'last_modified_date') {
    $sql .= " ORDER BY last_modified_date DESC";
} elseif ($tri == 'article') {
    $sql .= " ORDER BY question ASC";
}
    $requete = $conn->query($sql);
    $articles = $requete->fetchAll();
    return $articles;
    
}

//pour visualiser le contenu du tableau qui est récupéré (attention echo ne pourra pas afficher le tableau)

function findAllArticlesPagination($conn, $tri, $items_per_page, $offset) {
    $sql = "SELECT * FROM `articles`";

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
    $articles = $requete->fetchAll();
    return $articles;
}

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


// Fonction pour afficher les articles avec pagination
function displayArticlesWithPagination($conn, $tri, $items_per_page) {
    // Récupérer le numéro de page actuelle depuis l'URL, par défaut 1 si non spécifié
    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Récupérer le nombre total d'articles
    $total_items = count(findAllArticles($conn, $tri));

    // Calculer l'index de départ pour la requête SQL en fonction de la page actuelle
    $offset = ($current_page - 1) * $items_per_page;

    // Récupérer les articles pour la page actuelle en utilisant l'offset
    $articles = findAllArticlesPagination($conn, $tri, $items_per_page, $offset);

    // Afficher les articles
    foreach ($articles as $article) {
        // Affichage de chaque article
        echo '<tr>
                <td>' . $article['title'] . '</td>
                <td>' . $article['last_modified_date'] . '</td>
                <td>
                    <button type="button" class="btn btn-light trigger-btn-view" data-toggle="modal" data-target="#myModal" data-action="afficher" data-type="article" data-id="' . $article['id'] . '" data-title="' . $article['title'] . '" data-deskription="' . $article['deskription'] . '" data-lien="' . $article['origine'] . '">Afficher</button>
                </td>
                <td>
                    <button type="button" class="btn btn-light trigger-btn-modify" data-toggle="modal" data-target="#myModal" data-action="modifier" data-type="article" data-id="' . $article['id'] . '" data-title="' . $article['title'] . '" data-deskription="' . $article['deskription'] . '" data-lien="' . $article['origine'] . '">Modifier</button>
                </td>
                <td class="text-end">
                    <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-delete" data-toggle="modal" data-target="#myModal" data-action="supprimer" data-type="article" data-id="' . $article['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
            </tr>';
    }
    echo '</tbody>
        </table>';

    // Afficher la pagination
     // Définir votre URL de page ici
    $page_url = "?tri=$tri";
    $section = "articleContent";
    echo pagination($total_items, $items_per_page, $current_page, $page_url, $section);
}
