<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/database.fn.php';
require_once dirname(__DIR__, 2) . '/function/publications.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';
require_once dirname(__DIR__, 2) . '/function/faq_formations.fn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';
$conn = getPDOlink($config);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pauline</title>
  <link rel="stylesheet" href="../../assets/deco/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



  <!-- Lien CDN Orejime -->
  <link rel="stylesheet" href="https://unpkg.com/orejime@2.2.1/dist/orejime.css" />
  <script src="https://unpkg.com/orejime@2.2.1/dist/orejime.js"></script>





  <!-- logo page web -->
  <link rel="icon" href="../../assets/logos/logoFondRemoved.png" type="image/x-icon">
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LegalService",
      "name": "Pauline Rhoder Avocate et Formatrice",
      "description": "Pauline Rhoder, avocate et formatrice, offre des services juridiques en droit des personnes en milieu hospitalier psiquiatrique. Contactez notre avocate spécialisée dès aujourd'hui.",
      "openingHours": "Mo-Fr 09:00-17:00",
      "paymentAccepted": "Cash, Credit Card",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "127 Rue de Rome",
        "addressLocality": "Marseille",
        "postalCode": "13006",
        "addressCountry": "France"
      },
      "telephone": "+33 7 72 06 23 77",
      "email": "contact@rhenter-avocate-formatrice.fr",
      "priceRange": "€"
    }
  </script>
</head>

<body>

  <!-- <script src="Cookies_origime.js"></script> -->
  <!-- <div id="orejime"></div> -->
  <div id="app" class="app">
    <main class="bg-red-70">
  <?php    
   session_start();
// Vérifier si un message de succès est présent dans la session
if (isset($_SESSION['success_message'])) {
  // Afficher le message de succès
  echo '<div class="alert alert-success text-center position-fixed bottom-0 start-50 translate-middle-x session" role="alert"> <h6>' .  $_SESSION['success_message'] . '</h6> </div>';


  // Supprimer le message de succès de la session pour éviter qu'il ne soit affiché à nouveau
  unset($_SESSION['success_message']);
} ?>
<!-- JavaScript pour masquer le message de succès après 3 secondes -->
<script src="../../admin/js/hide_message.js"></script>
<script>
  hideSuccessMessage()
</script>
