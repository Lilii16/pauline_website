<script>
    // include "./script.js";
    window.onload = function() {
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
                        targetSection.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        }
    }
</script>


<section id="thematik-section" class="py-5" style="overflow-x: hidden;">
    <div class="bg-red wh-100 py-3">
        <h1 class="text-center" style="z-index: 1;">
            Usager ou professionnel, je souhaite me former 
        </h1>
    </div>

    <div class="m-md-5 bg-light-90-beige blur-beige p-2 p-md-5">
        <div class="formation row row-cols-1 row-cols-md-3 g-4 m-5 ">
            <?php
            require "table_formation.php";
            // Compteur pour créer des ID uniques pour chaque modal
            $modal_count = 0;
            // Boucle foreach pour parcourir le tableau des formations
            foreach ($formations as $formation) {
                $modal_count++;
            ?>
                <div class="col mb-5">
                    <div class="text-red text-center h-100 mb-5">
                        <i class="formation fa-solid <?php echo $formation['icone']; ?> card-img-top pb-4" alt="..."></i>
                        <div class="card-body text-dark">
                            <h5 class="card-title"><?php echo $formation['titre']; ?></h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn text-red col-md-4 col-6 rounded-pill border-3" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $modal_count; ?>">
                                <u>En savoir plus</u>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade " id="exampleModal<?php echo $modal_count; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $modal_count; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title text-red text-center fs-5" id="exampleModalLabel<?php echo $modal_count; ?>"><?php echo $formation['titre']; ?></h1>
                                <button type="button" class="btn-close bg-red" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                <p class="h5">
                                    <?php if (isset($formation['description'])) {
                                        echo $formation['description'];
                                    } else {
                                        echo "Contactez-moi pour plus d'informations";
                                    } ?>
                                </p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-red" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>


        <!-- <section id="devis-section"> -->
        <div class="card text-center bg-beige col-md-6 m-auto" id="devis-section">
            <div class="card-body">
                <p class="card-text">Chaque formation étant différente et personnalisable, il est nécéssaire d’estimer le coût via un devis. <br>
                    Contactez Pauline Renther afin d’avoir plus d’informations. </p>
                <a href="../../contact.php" class="btn text-red border border-warning col-md-4  col-6 rounded-pill border-3">Demander un devis</a>
            </div>
        </div>
        <!-- </section> -->


    </div>
</section>

<section class="py-5 section_formation" style="overflow-x: hidden !important;">
    <div class="bg-red wh-100 py-3" id="faq-section">

        <h1 class="text-center" style="z-index: 1;">
            Questions fréquentes
        </h1>
    </div>

    <div class="my-md-5 bg-light-90-beige blur-beige p-md-5">
        <!-- premiere card questions frequentes -->
        <?php
        $questions = findAllQuestionsFormation($conn);
        foreach ($questions as $question) {
        ?>
            <div class="col-md-6 col-10 m-auto text-center py-5">

                <div class="" style="margin-bottom: -20px; z-index: 2 !important; position:relative;">
                    <h5 class="m-auto text-dark col-md-10 bg-light-beige rounded-md-pill rounded-5 p-2 p-md-4"><?php echo $question['question']; ?></h5>
                </div>

                <div class="card-body bg-wine rounded-5 col-12 pt-3">
                    <p class="card-text text-light-beige px-md-3 p-1 pt-5"><?php echo $question['reponse']; ?></p>
                    <p class="text-end p-3"><a href="#" class="text-light-beige"><u>voir plus</u></a></p>
                </div>
            </div>

        <?php
        }
        ?>

        <p class="text-dark text-center fw-bold">Voir plus de questions, ici.</p>
    </div>

    <img src="../../assets/deco/deco_bulle.svg" alt="Bulle droite" class="bubble formation right absolute ">

</section>


<section class="py-5" style="overflow-x: hidden;">
    <div class="bg-red wh-100 py-3">
        <h1 class="text-center" style="z-index: 1;">
            Posture pédagogique et tarifs des formations
        </h1>
    </div>

    <div class="my-md-5 bg-light-90-beige p-5">
        <div class="container m-5 border border-5 border-danger p-5 ">
        <div class="text-red text-center">
    <h2>Objectifs pédagogiques :</h2>
    <ul class="">
        <li>Acquérir des connaissances de base</li>
        <li>Développer des compétences en termes d’accès aux droits et de plaidoyer</li>
        <li>Découvrir les ressources disponibles au niveau national et local</li>
        <li>Maîtriser la jurisprudence (pour les avocat.e.s)</li>
    </ul>

    <h2>Méthode :</h2>
    <ul>
        <li>Recueil des besoins de formation par téléphone ou par questionnaire</li>
        <li>Proposition devisée</li>
        <li>Convention</li>
    </ul>

    <h2>Animation :</h2>
    <ul>
        <li>Outils participatifs</li>
        <li>Facilitation visuelle</li>
    </ul>

    <p>Format : en présentiel ou en visio</p>
    <p>Participants : professionnels, personnes concernées, proches ou groupe mixte</p>

    <h2>Tarifs :</h2>
    <p>Formation thématique à l’heure : 135 euros / heure + frais de transports et d’hébergement</p>
    <p>Ou forfait « journée » déterminé avec le client</p>
    <p>Possibilité de souscrire à un contrat d’abonnement mensuel pour du conseil juridique par téléphone (par exemple : 3 heures par mois pour une association d’usagers, une structure sanitaire, médico-sociale ou sociale)</p>
</div>


        </div>


    </div>
</section>