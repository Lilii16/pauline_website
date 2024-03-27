<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
    <title>Barre de Navigation</title>
</head>
<body>
    <h1>Barre de Navigation</h1>
    <nav>
        <select id="selectSection">
            <option value="">Choisir une section</option>
            <option value="section1">Section 1</option>
            <option value="section2">Section 2</option>
            <!-- Ajoutez d'autres options au besoin -->
        </select>
    </nav>

    <!-- Ajoutez d'autres éléments de contenu ici -->

    <script>
        // Redirection vers la section correspondante lorsqu'une option est sélectionnée
        document.getElementById('selectSection').addEventListener('change', function() {
            var selectedSection = this.value;
            if (selectedSection) {
                window.location.href = 'page_cible.html#' + selectedSection;
            }
        });
    </script>
</body>
</html>
