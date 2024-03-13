<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/database.fn.php';
session_start();

// Vérifier si l'utilisateur est déjà connecté, le rediriger vers le tableau de bord s'il l'est
if (isset($_SESSION['user'])) {
    header("Location: ../dashboard.php");
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Établir la connexion à la base de données
    $conn = getPDOlink($config);

    // Requête SQL préparée pour vérifier les informations d'identification et éviter les injections SQL
    $sql = "SELECT * FROM `user` WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $password]);

      // Vérification du résultat de la requête
      $result = $stmt->fetch();

    // Vérifier les informations d'identification (vous devez implémenter votre propre logique d'authentification)
    if ($result) {
        // L'utilisateur est authentifié, démarrer la session et rediriger vers le tableau de bord
        $_SESSION['user'] = $username;
        header("Location: ../dashboard.php");
        exit;
    } else {
        // Afficher un message d'erreur si les informations d'identification sont incorrectes
        $error = "Identifiant ou mot de passe incorrect.";
    }
}
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

<body>
    <h1>Bienvenue à ton espace admnistrateur</h1>
    <h2>Connecte toi pour avoir accès</h2>

<div class=" m-auto">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="mb-3 col-6">
      <label for="username" class="form-label">Nom d'utilisateur :</label>
      <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>

      <div id="emailHelp" class="form-text">We'll never share your email with anyone else wink wink.</div>
    </div>

    <div class="mb-3 col-6">
      <label for="password" class="form-label">Mot de passe :</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <?php if(isset($error)) { echo "<p>$error</p>"; } ?>

    <button type="submit" value="Se connecter" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>

</html>
