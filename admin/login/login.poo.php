<?php
// Vérifier si l'utilisateur est déjà connecté, le rediriger vers le tableau de bord s'il l'est
// if (isset($_SESSION['user'])) {
//     header("Location: ../dashboard.php");
//     exit;
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- CSS Custom -->
  <link rel="stylesheet" href="style.css">
  <title>Connexion</title>
</head>

<body class="container col-md-6 text-center">

    <h1>Bienvenue à ton espace admnistrateur</h1>
    <h3 class="mb-5">Connecte toi pour avoir access</h3>

    <?php  
    if (session_status() === PHP_SESSION_ACTIVE) {
      // La session est active, procédez avec le reste du code
      echo "Session is active.";
  }
    ?>

<div class="bg-container" >
    <form  action="./includes/login.inc.php" method="Post">
    <div class="mb-3">
      <label for="username" class="form-label">Nom d'utilisateur :</label>
      <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>

      <div id="emailHelp" class="form-text">We'll never share your email with anyone else wink wink.</div>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe :</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" value="Se connecter" class="btn btn-primary">Submit</button>
  </form>

  <?php
  // Démarrage de la session si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_GET['login'])) {
  require_once './includes/config_session.inc.php';
  require_once './includes/login_view.inc.php';
  check_login_errors();
}

  ?>
</div>
</body>

</html>
