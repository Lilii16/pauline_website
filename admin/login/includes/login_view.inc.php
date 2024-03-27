<?php

declare(strict_types=1);

function output_username()
{
if (isset($_SESSION["user_username"])) {
echo "You are logged in as " . $_SESSION["user_username"];
} else {
echo "Tu n'est pas connecté";
var_dump($_SESSION['user_username']);
}
}

//on le voit pas pour l'instant
function check_login_errors()
{

if (isset($_SESSION["errors_login"])) {
$errors = $_SESSION["errors_login"];
echo "<br>";
foreach ($errors as $error) {
echo '<p class="text-danger">' . $error . '</p>';
// session_unset(); 
}

// unset($_SESSION['errors_login']);
} else if (isset($_GET['login']) && $_GET['login'] === "success") {
echo '<br>';
echo '<p class="text-success"> Login success ! </p>';
} 
//verification erreur
else{
    echo '<br>';
    echo "oups";
}
}