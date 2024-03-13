<?php 
require_once 'database.fn.php';


// Établir la connexion à la base de données
   $conn = getPDOlink($config);

//création fonction qui permet de récupérer les questions de la bdd pour la page ressouce

function findAllQuestions($conn){
    $sql= "SELECT * FROM `questions`";
    $requete = $conn->query($sql);
    $questions = $requete->fetchAll();
    return $questions;
}

//pour visualiser le contenu du tableau qui est récupéré (attention echo ne pourra pas afficher le tableau)

//function pour delete les questions via leur id :


function findQuestionById($conn, $currentID) {
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

function deleteQuestionById($conn, $currentID) {
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
