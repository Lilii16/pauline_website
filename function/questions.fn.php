<?php

//création fonction qui permet de récupérer les questions de la bdd pour la page ressouce

function findAllQuestions($conn, $tri = '') {
    $sql = "SELECT * FROM `questions`";
    

// crée une fonction generale plus tard attention
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de la valeur sélectionnée dans le formulaire
    $tri = $_POST["tri"];
}
   // Ajout du tri si un critère de tri est spécifié
   if ($tri == 'last_modified_date') {
    $sql .= " ORDER BY last_modified_date DESC";
} elseif ($tri == 'question') {
    $sql .= " ORDER BY question ASC";
}
    $requete = $conn->query($sql);
    $questions = $requete->fetchAll();
    return $questions;
}

function findAllQuestionsPagination($conn, $tri, $items_per_page, $offset) {
    $sql = "SELECT * FROM `questions`";

    // Ajout du tri si un critère de tri est spécifié
    if ($tri == 'last_modified_date') {
        $sql .= " ORDER BY last_modified_date DESC";
    } elseif ($tri == 'question') {
        $sql .= " ORDER BY question ASC";
    }

    // Ajout de l'offset et du nombre d'éléments par page
    $sql .= " LIMIT $offset, $items_per_page";

    // Exécution de la requête SQL
    $requete = $conn->query($sql);
    $questions = $requete->fetchAll();
    return $questions;
}


//pour visualiser le contenu du tableau qui est récupéré (attention echo ne pourra pas afficher le tableau)

//function pour delete les questions via leur id :


function findQuestionById($conn, $currentID)
{
    try {
        // Préparation de la requête SQL pour sélectionner la question avec l'ID spécifié
        $sql = "SELECT id, question, reponse FROM questions WHERE id = :id";

        // Préparation de la requête
        $stmt = $conn->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':id', $currentID, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupération de la question
        $question = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retourne la question
        return $question;
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}

function deleteQuestionById($conn, $currentID)
{
    try {
        // Préparation de la requête SQL pour supprimer l'élément avec l'ID spécifié
        $sql = "DELETE FROM questions WHERE id = :id";

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


function updateQuestion($conn, $currentId)
{
    try {
        // Stocker les données actuelles avant la mise à jour
        $currentData = findQuestionById($conn, $currentId);
        $currentDate = date('Y-m-d');

        // Stocker les données actuelles avant la mise à jour
        $question = isset($_POST['question']) ? htmlspecialchars($_POST['question']) : '';
        $reponse = isset($_POST['reponse']) ? htmlspecialchars($_POST['reponse']) : '';
        // $currentData = findQuestionById($conn, $currentId);
        $oldData = $currentData;

        // Préparer les valeurs à mettre à jour
        $updateValues = array();
        $params = array();

        // Vérifier chaque champ s'il a changé
        if ($question != $oldData['question']) {
            $updateValues[] = "question = ?";
            $params[] = $question;
        }
        if ($reponse != $oldData['reponse']) {
            $updateValues[] = "reponse = ?";
            $params[] = $reponse;
        }

        // S'il y a des valeurs à mettre à jour, exécuter la requête SQL
        if (!empty($updateValues)) {
            $updateValues[] = "last_modified_date = ?";
            $params[] = $currentDate;

            // Construire la requête SQL avec des déclarations préparées
            $updateString = implode(', ', $updateValues);
            $sql = "UPDATE questions SET $updateString WHERE id = ?";
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




// Fonction pour afficher les questions avec pagination
// Fonction pour afficher les questions avec pagination
function displayQuestionsWithPagination($conn, $tri, $items_per_page) {
    // Récupérer le numéro de page actuelle depuis l'URL, par défaut 1 si non spécifié
    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Récupérer le nombre total de questions
    $total_items = count(findAllQuestions($conn, $tri));

    // Calculer l'index de départ pour la requête SQL en fonction de la page actuelle
    $offset = ($current_page - 1) * $items_per_page;

    // Récupérer les questions pour la page actuelle en utilisant l'offset
    $questions = findAllQuestionsPagination($conn, $tri, $items_per_page, $offset);

    // Afficher les questions
    foreach ($questions as $question) {
        // Affichage de chaque question
        echo  '<tr>
        <td>' . $question['question'] . '</td>
        <td>' . $question['last_modified_date'] . '</td>
        <td>
            <button type="button" class="btn btn-light trigger-btn-view" data-toggle="modal" data-target="#myModal" data-action="afficher" data-type="question" data-id="' . $question['id'] . '" data-title="' . $question['question'] . '" data-description="' . $question['reponse'] . '">Afficher</button>
        </td>
        <td>
            <button type="button" class="btn btn-light trigger-btn-modify" data-toggle="modal" data-target="#myModal" data-action="modifier" data-type="question" data-id="' . $question['id'] . '" data-title="' . $question['question'] . '" data-description="' . $question['reponse'] . '">Modifier</button>
        </td>
        <td class="text-end">
            <button type="button" class="btn  btn-sm btn-square btn-neutral btn-light trigger-btn-delete" data-toggle="modal" data-target="#myModal" data-action="supprimer" data-type="question" data-id="' . $question['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </td>
        </tr>';
    }
    echo '</tbody></table>'; // Fermeture de la balise <tbody> et <table>

    // Afficher la pagination
    if (!function_exists('pagination')) {
        include 'pagination.fn.php';
    }
    $page_url = "?tri=$tri"; // Définir votre URL de page ici
    $section = "questionContent"; // Mettez votre section ici si nécessaire
    echo pagination($total_items, $items_per_page, $current_page, $page_url, $section);
}




