<?php 
include "../../composant_general/header.php";
require_once dirname(__DIR__, 3) . '/config/conn.php';
require_once dirname(__DIR__, 3) . '/function/questions.fn.php';
?>

<section class="py-5 section_juridique" style="overflow: hidden;">
    <div class="titre bg-red wh-100 front py-3">
        <h1 class="text-center" style="z-index: 1;">Questions fréquentes</h1>
    </div>
    <div class="rotate bg-light-90-beige blur-beige" style="overflow: hidden;">
        <div class="container container-lg rotate-minus20">
            <div class="row">
                <?php
                $questions = findAllQuestions($conn);
                foreach ($questions as $question) {
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-10 py-3">
                        <span class="border-4" style="color: #F0C587 !important;">
                            <div class="card w-100 custom-card shadow-sm" style="background-color: #A30001">
                                <div class="card-header">
                                    <h5 class="card-title text-center"><?php echo $question['question']; ?></h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-text text-center"><?php echo $question['reponse']; ?></h6>
                                </div>
                            </div>
                        </span>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
