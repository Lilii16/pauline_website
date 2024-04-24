<?php


// Configuration pour utiliser uniquement les cookies pour la session et activer le mode strict.
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// Configuration des paramètres du cookie de session.
session_set_cookie_params([
    'lifetime' => 1800,  // Durée de vie du cookie de session en secondes (ici, 30 minutes).
    'domain' => 'pauline-website',  // Domaine sur lequel le cookie de session est valide.
    'path' => '/',  // Chemin sur le serveur où le cookie de session est disponible.
    //petit probleme a regler sur le site hebergé mettre secure = true et verifier s'il marche ou pas
    'secure' => false,  // Indique si le cookie de session doit être transmis uniquement via une connexion HTTPS.
    'httponly' => true  // Indique que le cookie de session ne peut être accédé que via HTTP et pas via JavaScript.
]);

// Démarrage de la session si le formulaire est soumis
    session_start();

if(isset($_SESSION["user_id"])){
  // Vérification si la variable de session "last_regeneration" n'existe pas.
  if (!isset($_SESSION["last_regeneration"])) {
    // Si elle n'existe pas, régénérer l'identifiant de session.
    regenerate_session_id_loggedin();

} else {
    // Si elle existe, vérifier si le temps écoulé depuis la dernière régénération dépasse l'intervalle défini (30 minutes).
    $interval = 60 * 30; // 30 minutes en secondes.
    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        // Si le temps écoulé dépasse l'intervalle, régénérer l'identifiant de session.
        regenerate_session_id_loggedin();
    }
}  
    
}else{
  // Vérification si la variable de session "last_regeneration" n'existe pas.
if (!isset($_SESSION["last_regeneration"])) {
    // Si elle n'existe pas, régénérer l'identifiant de session.
    regenerate_session_id();

} else {
    // Si elle existe, vérifier si le temps écoulé depuis la dernière régénération dépasse l'intervalle défini (30 minutes).
    $interval = 60 * 30; // 30 minutes en secondes.
    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        // Si le temps écoulé dépasse l'intervalle, régénérer l'identifiant de session.
        regenerate_session_id();
    }
}  
}


// Définition de la fonction pour régénérer l'identifiant de session.
function regenerate_session_id_loggedin()
{
    // Régénérer l'identifiant de session.
    session_regenerate_id(true);

    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId. "_" . $userId;
    session_id( $sessionId);
    // Mettre à jour le timestamp de la dernière régénération dans la variable de session "last_regeneration".
    $_SESSION["last_regeneration"] = time();
    // var_dump($_SESSION);
    
}
// Définition de la fonction pour régénérer l'identifiant de session.
function regenerate_session_id()
{
    // Régénérer l'identifiant de session.
    session_regenerate_id(true);
    // Mettre à jour le timestamp de la dernière régénération dans la variable de session "last_regeneration".
    $_SESSION["last_regeneration"] = time();
}