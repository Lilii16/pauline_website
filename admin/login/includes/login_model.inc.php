<?php

declare(strict_types=1);

function get_user(object $conn, string $username)
{
// Requête SQL préparée pour vérifier les informations d'identification et éviter les injections SQL
$query = "SELECT * FROM user WHERE username = :username;";
$stmt = $conn->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();
 // récupere le premier résultat de la requête
$result = $stmt->fetch(PDO :: FETCH_ASSOC);
return $result;
}



// fonction qui permet de creer le user et mot de pass
// function set_user(object $conn, string $username)
// {
//     $username = "pauline.p";
//     $password = 'rhenter24';
//     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
//     // Préparation de la requête
//     $query = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    
//     // Liaison des paramètres
//     $query->bindParam(':username', $username);
//     $query->bindParam(':password', $hashed_password);
    
//     // Exécution de la requête
//     $query->execute();
// }

