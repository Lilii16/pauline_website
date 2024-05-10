<?php 
function pagination($total_items, $items_per_page, $current_page, $page_url, $section) {
    // Calculer le nombre total de pages
    $total_pages = ceil($total_items / $items_per_page);

    // Afficher les liens de pagination
    $pagination = '<div class="d-flex justify-content-center"> <ul class="pagination">';

    // Lien vers la première page
    $pagination .= '<li class="page-item"><a class="page-link link-beige bg-wine" href="' . $page_url . '&page=1&section=' . $section . '">Première</a></li>';

    // Lien vers les pages précédentes
    for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $total_pages); $i++) {
        $pagination .= '<li class="page-item ' . ($current_page == $i ? 'active' : '') . '"><a class="page-link link-beige bg-wine" href="' . $page_url . '&page=' . $i . '&section=' . $section . '">' . $i . '</a></li>';
    }

    // Lien vers la dernière page
    $pagination .= '<li class="page-item"><a class="page-link link-beige bg-wine" href="' . $page_url . '&page=' . $total_pages . '&section=' . $section . '">Dernière</a></li>';

    $pagination .= '</div></ul>';

    return $pagination;
}
?>
