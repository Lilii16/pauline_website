<?php
// Établir la connexion à la base de données
$conn = getPDOlink($config);

//création fonction qui permet de récupérer les questions de la bdd pour la page fas-formation

function findAllQuestionsFormation($conn){
    $sql= "SELECT * FROM `faq-formation`";
    $requete = $conn->query($sql);
    $questions = $requete->fetchAll();
    return $questions;
}


//création fonction qui permet de récupérer les questions de la bdd pour la page ressouce
function findAllQuestionsFormationById($conn, $currentID) {
    try {
        // Préparation de la requête SQL pour sélectionner l'article avec l'ID spécifié
        $sql = "SELECT id, question, `reponse` FROM faq-formation WHERE id = :id";
        
        // Préparation de la requête
        $stmt = $conn->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $currentID, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Récupération de l'article
        $questions = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Retourne l'article
        return $questions;
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}

function deleteQuestionsFormationById($conn, $currentID) {
    try {
        // Préparation de la requête SQL pour supprimer l'élément avec l'ID spécifié
        $sql = "DELETE FROM faq-formation WHERE id = :id";
        
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