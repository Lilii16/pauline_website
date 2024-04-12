<?php
// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];
    //on va utiliser un try catch pour gerer les erreurs
    try {
        //On recupére la connection à la bdd
        require_once dirname(__DIR__, 3) . '/config/conn.php';
        require_once dirname(__DIR__, 3) . '/function/database.fn.php';
        // Établir la connexion à la base de données
        $conn = getPDOlink($config);


        // ensuite on va récupérer le model et le control dans cet ordre precise
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';


        //ici on va gerer les erreurs 
        $errors = [];
        // on verifie si les input sont vides
        if (is_input_empty($username, $password)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        //on récupere les données du tableau sql
        $result = get_user($conn, $username);
        $hashedPwd = $result["password"];



        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info username!";
        }
        //verification si le mot de pass est incorrect et si il match avec username (dans result)
        // if (!is_username_wrong($result) && is_password_wrong($password, $result["password"])) {
        //     $errors["login_incorrect"] = "Incorrect login info password!";
        // }

        // Vérification si le nom d'utilisateur est incorrect
        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info username!";
        } else {
            // Vérification du mot de passe si le nom d'utilisateur est correct
            if (is_password_wrong($password, $result["password"])) {
                $errors["login_incorrect"] = "Incorrect login info password!";
            }
        }

        if ($errors) {
            // on inclu notre fichier de session qui va gerer la sécurité de la session
            require_once 'config_session.inc.php';
            $_SESSION["errors_login"] = $errors;
          
            header("Location: ../login.poo.php?login=unsuccess");

            die();
        }
        //si tout est correct : 
        //creates a new id for security if we have a user id we can append it 
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);
        // on inclu notre fichier de session qui va gerer la sécurité de la session
        require_once 'config_session.inc.php';


        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();
    
        header("Location: ../../dashboard.php?login=success");
        $pdo = null;
        $statement = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    //si l'utilisateur est arrivé a cette page par un autre moyen que le formulaire renvoyer vers login
    // header("Location: ../login.poo.php");
    die();
}
