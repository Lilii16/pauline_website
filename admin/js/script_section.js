function activateTabFromURL() {
    document.addEventListener('DOMContentLoaded', function() {
        // Récupère la section spécifiée dans l'URL
        var section = '<?php echo isset($_GET["section"]) ? $_GET["section"] : ""; ?>';

        // Si une section est spécifiée, active l'onglet correspondant
        if (section) {
            var tabPane = document.getElementById(section);
            if (tabPane) {
                var tabId = tabPane.getAttribute("aria-labelledby");
                var tab = document.getElementById(tabId);
                if (tab) {
                    tab.click(); // Active l'onglet
                }
            }
        }
    });
}
