<?php
include "./script.js";
?>
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
            // Boucle foreach pour parcourir le tableau des formations
            foreach ($formations as $formation) {
            ?>
                <div class="col mb-5">
                    <div class="text-red text-center h-100 mb-5">
                        <i class="formation fa-solid <?php echo $formation['icone']; ?> card-img-top pb-4" alt="..."></i>
                        <div class="card-body text-dark">
                            <h5 class="card-title"><?php echo $formation['titre']; ?></h5>
                            <a href="<?php echo $formation['lien']; ?>" class="btn text-red col-md-4 col-6 rounded-pill border-3"><u>En savoir plus</u></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        <section id="devis-section">
        <div class="card text-center bg-beige col-md-6 m-auto">
            <div class="card-body">
                <p class="card-text">Chaque formation étant différente et personnalisable, il est nécéssaire d’estimer le coût via un devis. <br>
                    Contactez Pauline Renther afin d’avoir plus d’informations. </p>
                <a href="#" class="btn text-red border border-warning col-md-4  col-6 rounded-pill border-3">Demander un devis</a>
            </div>
        </div>
        </section>


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
                    <p class="card-text text-light-beige p-1 pt-5"><?php echo $question['reponse']; ?></p>
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