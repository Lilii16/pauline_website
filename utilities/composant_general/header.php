<?php
require_once dirname(__DIR__, 2) . '/config/conn.php';
require_once dirname(__DIR__, 2) . '/function/publications.fn.php';
require_once dirname(__DIR__, 2) . '/function/articles.fn.php';
require_once dirname(__DIR__, 2) . '/function/faq_formations.fn.php';
require_once dirname(__DIR__, 2) . '/function/questions.fn.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pauline</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- <script src="../../script.js"></script> -->
  <!-- <script src="../../script_navBar.js"></script> -->



  <!-- Lien cdn orejime pour la gestion des cookies-->
  <link rel="stylesheet" href="https://unpkg.com/orejime@latest/dist/orejime.css" />
  <script src="https://unpkg.com/orejime@latest/dist/orejime.js"></script>
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


<style>
    /* Personnalisation de la notification de consentement */
.orijime-notice {
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #333;
}

.orijime-notice button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
}

.orijime-notice button:hover {
    background-color: #0056b3;
}


/* custom-style.css */
.orejime-Notice,
.orejime-Modal {
    background: pink;
    color: white;
}
</style>
<body>

<script>
  window.orejimeConfig = {
elementID: "orejime",
appElement: "#app",
privacyPolicy: "mentions-legales",
mustConsent: true,
mustNotice: true,

lang: "fr",
translations: {
fr: {

consentModal: {
title: "Les informations que nous collectons",
description: "Ici, vous pouvez voir et personnaliser les informations que nous collectons sur vous. \n",
privacypolicy: {
name: "politique de confidentialité",
text: "Pour en savoir plus, merci de lire notre {privacypolicy}. \n"
},
},
save: "Confirmer la sélection",

purposes: {
required: 'Indispensable au fonctionnement technique du site',
security: 'Securité',
analytics: 'Mesure d\'audience',
woopra: 'Mesure d\'audience et personnalisation du contenu',
googledv: 'Publicite ciblee',
marketing: 'Marketing',
iframes: 'Lecture de videos sur le site',
},
},
},
apps: [{

name: "RhenterAvocate",
title: "RhenterAvocate",
cookies: [
'RhenterAvocate',
],
purposes: ["required"],
required: false,
optout: false,
default: true,
onlyOnce: true,

}
],
categories: [{
title: "Cookies necessaires",
description: "Les cookies necessaires contribuent à rendre un site web utilisable en activant des fonctions de base comm",
apps: ['votresite']
}]
  }
</script>
  <main class="bg-red-70">

