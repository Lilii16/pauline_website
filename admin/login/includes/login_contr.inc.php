<?php

declare(strict_types=1);

//ici on va gerer les erreurs de connexion

// verifier si les input sont vides
function is_input_empty(string $username, string $password)
{
if (empty($username) || empty($password)) {
return true;
} else {
return false;
}
}


//on va combiner  types car dependant du resultat on peut soit avoir un tableau soit un false

function is_username_wrong(bool|array $result)
{
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

//verification si password match avec celui stocké en format hashé avec password_verify 
function is_password_wrong(string $password, string $hashedPwd)
{

if (!password_verify($password, $hashedPwd) ) {
return true;
}
else {
return false;
}
}
