<?php
    // include "../composant_general/header.php";
    // require_once dirname(__DIR__, 2) . '/config/conn.php';
    // require_once dirname(__DIR__, 2) . '/function/publications.fn.php';
    // require_once dirname(__DIR__, 2) . '/function/articles.fn.php';
    ?>

<section class="bg-red-70 pb-5">
    <h1 class="text-light-beige text-center bg-orange m-0 wh-100">Publications et autres ressources</h1>
    <div class="container personnel" style="max-width:  90% !important;">
        <h3 class="text-red bg-light-beige p-0 my-5">Publications personnelles en ligne ou à télécharger en PDF</h3>
        <div class="bg-orange rounded-5" style="border-top-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
            <!-- foreachici -->
            <?php
            $publications = findAllPublications($conn);

            foreach ($publications as $publication) {
            ?>
                <div class="m-3 d-flex justify-content-between align-items-center py-2">
                    <div class="text-light-beige">
                        <p><?php echo $publication['titre']; ?></p>
                        <p><?php echo $publication['description']; ?></p>
                    </div>
                    <a href="<?php echo $publication['lien']; ?>" class="bg-light-beige p-1" download>Telecharger</a>
                </div>
                <hr class="text-blue p-1 d-flex m-auto border-3 col-10">
            <?php
            }
            ?>
            <!-- chercher comment inverser au bout de 2 -->
        </div>
    </div>

    <!-- div avec les liens utiles -->
    <div class="container liens" style="max-width:  90% !important;">
        <h3 class="text-red bg-light-beige p-0 my-5">Liens utiles</h3>
        <!-- foreacheici -->
        <div class="row row-cols-md-3 justify-content-evenly">
            <?php
            $articles = findAllArticles($conn);

            foreach ($articles as $article) {
            ?>

                <div class="bg-orange rounded-5 m-4" style="border-top-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                    <div class="m-3 text-center text-light-beige py-2">
                        <p><?php echo $article['title']; ?></p>
                        <p><?php echo $article['deskription']; ?></p>
                        <a href="<?php echo $article['origine']; ?>" class="bg-light-beige p-1">suivre le lien</a>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</section>



















<!-- 
code utile -->
<!-- <div class="container liens" style="max-width:  90% !important;">
            <h3 class="text-red bg-light-beige p-0 my-5">Publications personnelles en ligne ou à télécharger en PDF</h3>
               
                <?php
                // $publications = findAllPublications($conn);

                // foreach ($publications as $publication) {
                ?>
                <div class="bg-orange rounded-5" style="border-top-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                    <div class="m-3 d-flex justify-content-between align-items-center py-2">
                        <div class="text-light-beige">
                            <p><?php //echo $publication['titre']; 
                                ?></p>
                            <p><?php //echo $publication['description']; 
                                ?></p>
                        </div>
                        <a href="<?php //echo $publication['lien']; 
                                    ?>" class="bg-light-beige p-1" download>Telecharger</a>
                    </div>
                     </div>
                <?php
                //  }
                ?>

        </div> -->