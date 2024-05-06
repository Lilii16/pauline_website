function displayWithPagination($conn, $data_type, $tri, $items_per_page) {
    // Récupérer le numéro de page actuelle depuis l'URL, par défaut 1 si non spécifié
    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Calculer l'index de départ pour la requête SQL en fonction de la page actuelle
    $offset = ($current_page - 1) * $items_per_page;

    // Récupérer les données pour la page actuelle en utilisant l'offset et le nombre d'éléments par page
    if ($data_type == 'questions') {
        $data = findAllQuestions($conn, $tri, $items_per_page, $offset);
        $total_items = count(findAllQuestions($conn, $tri));
    } elseif ($data_type == 'articles') {
        $data = findAllArticles($conn, $tri, $items_per_page, $offset);
        $total_items = count(findAllArticles($conn, $tri));
    }

    // Afficher les données
    foreach ($data as $item) {
        // Affichage de chaque item
        echo "<p>" . $item['title'] . "</p>";
        echo "<p>" . $item['content'] . "</p>";
    }

    // Générer et afficher la pagination
    echo pagination($total_items, $items_per_page, $current_page, "page.php?tri=$tri");
}
