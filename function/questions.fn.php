<?php
// require_once 'database.fn.php';


// Établir la connexion à la base de données
// $conn = getPDOlink($config);

//création fonction qui permet de récupérer les questions de la bdd pour la page ressouce

function findAllQuestions($conn)
{
    $sql = "SELECT * FROM `questions`";
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
