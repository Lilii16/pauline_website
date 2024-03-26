window.onload = function() {
    // Sélectionne les sections correspondant à l'identifiant unique sur la page avocate.php
    let competencesSection = document.getElementById('competences-section');
    let honorairesSection = document.getElementById('honoraires-section');
    let questionsSectionAvocate = document.getElementById('questions-section');

    // Vérifie si les sections correspondantes ont été trouvées sur la page avocate.php
    if (competencesSection && honorairesSection && questionsSectionAvocate) {
        // Ajoute un écouteur d'événement au clic sur un élément du menu dropdown
        document.querySelectorAll('.dropdown-item').forEach(function(item) {
            item.addEventListener('click', function() {
                // Récupère l'identifiant de la section cible à partir de l'attribut href
                let targetId = this.getAttribute('href').substring(1);
                // Sélectionne la section cible par son identifiant
                let targetSection = document.getElementById(targetId);
                // Si la section cible existe, faites défiler jusqu'à elle en douceur
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    }

    // Sélectionne les sections correspondant à l'identifiant unique sur la page formations.php
    let thematikSection = document.getElementById('thematik-section');
    let faqSectionFormations = document.getElementById('faq-section');
    let devisSectionFormations = document.getElementById('devis-section');
    // Vérifie si les sections correspondantes ont été trouvées sur la page formations.php
    if (thematikSection && faqSectionFormations && devisSectionFormations) {
        // Ajoute un écouteur d'événement au clic sur un élément du menu dropdown
        document.querySelectorAll('.dropdown-item').forEach(function(item) {
            item.addEventListener('click', function() {
                // Récupère l'identifiant de la section cible à partir de l'attribut href
                let targetId = this.getAttribute('href').substring(1);
                // Sélectionne la section cible par son identifiant
                let targetSection = document.getElementById(targetId);
                // Si la section cible existe, faites défiler jusqu'à elle en douceur
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    }
}
