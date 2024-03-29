<?php 
//classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
  $name = clean_input($_POST["name"]);
  $email = clean_input($_POST["email"]);
  $message = clean_input($_POST["message"]);
$sujet = clean_input($_POST["sujet"]);
$firstname  = clean_input($_POST["firstName"]);
$selectedOption  = clean_input($_POST["selectedOption"]);
// on devrai peut etre rajouter sujet et cela nous permettrai de faire un système de trie dans la boite de mail
$message= $_POST["message"];
echo("hello");

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    //  $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
    $mail->Host = 'smtp.hostinger.fr';
    $mail->SMTPAuth = true;
      //SMTP username //SMTP password
    $mail->Username   = 'contact@becker-avocate.fr';                     
    $mail->Password   = 'Bananes-98';  
      //Enable implicit TLS encryption                          
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
    $mail->Port       = 587;  
    //ici on choisit qui envoie
    $mail->setFrom('contact@becker-avocate.fr', $name, $firstname);
    //  c'est ici qu'on choisit ou envoyer 
    $mail->addAddress('sonia.98.tavares@gmail.com', 'Moi'); 
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        //content of email
        $mail->Subject = $sujet;
        $mail->isHTML(false);
        //  Cela commence une affectation de chaîne de texte à la propriété Body de l'objet $mail
        // chaîne heredoc est une manière pratique de définir des chaînes de texte sur plusieurs lignes en PHP. Elle est souvent utilisée pour insérer de grandes portions de texte sans avoir à échapper des guillemets ou des apostrophes
        $mail->Body = <<<EOT
E-mail: {$_POST['email']}
Nom: {$_POST['name']}
PRENOM: {$_POST['firstName']}
OPTION: {$_POST['selectedOption']}
MESSAGE: {$_POST['message']}
EOT;
        if (!$mail->send()) {
            $msg = 'Désolé, quelque chose a mal tourné. Veuillez réessayer plus tard.';
        } else {
            $msg = 'Message envoyé ! Merci de nous avoir contactés.';
        }
    } else {
        $msg = 'Partagez-les avec nous !';
    }

    // Fonction pour nettoyer les données entrées par l'utilisateur
function clean_input($data) {
    // Supprime les espaces en début et en fin de chaîne
    $data = trim($data);
    // Supprime les barres obliques inverses (\)
    $data = stripslashes($data);
    // Convertit les caractères spéciaux en entités HTML
    $data = htmlspecialchars($data);
    return $data;
}
?>

    