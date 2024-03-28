<div class="m-5 p-2"></div>
<script>
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
            targetSection.scrollIntoView({
              behavior: 'smooth'
            });
          }
        });
      });
    }

  }
</script>

<section id="competences-section" class="py-5 section_juridique" style="overflow: hidden;">
  <div class="bg-red wh-100 front py-3">
    <h1 class="text-center " style="z-index: 1;">
      Domaines de compétences
    </h1>
  </div>
  <div class="rotate bg-light-90-beige blur-beige" style="overflow: hidden;">
    <div class="container rotate-minus20 col-md-8 ">
      <div class="container ms-md-5">
        <p class="text-red">
          Ma pratique est essentiellement centrée sur la défense des droits des personnes accompagnées en psychiatrie, et plus particulièrement de leur droit à contester des soins contraints ou de demander réparation pour des préjudices subis du fait de soins imposés.
        </p>
        <p class=" text-red pt-2">
          J’interviens plus généralement s’agissant des mesures restrictives de liberté en lien avec la condition de « patient en psychiatrie » :
        </p>
        <p class="p-0 text-red">• protection des majeurs (tutelle ou curatelle), </p>
        <p class="p-0 m-0 text-red ">• accès au statut de personne en situation de handicap </p>

        <p class="text-red ">
          Par ailleurs, dès mon entrée dans la profession, j’ai intégré les listes de défense pénale d’urgence, de défense des victimes et de défense des mineurs pour assurer le rôle d’avocat commis d’office.
        </p>
      </div>
    </div>
  </div>
  <!-- ca va probablement dans le css -->
  <img src="../../../assets/deco/deco_bulle.svg" alt="Bulle gauche" class="bubble left">
  <img src="../../../assets/deco/deco_bulle.svg" alt="Bulle droite" class="bubble right">
</section>

<!-- section  honoraires -->

<section id="honoraires-section" class="py-5 section_juridique" style="overflow: hidden;">
  <div class="bg-light-90-beige wh-100 front py-3">
    <h1 class="text-center text-red" style="z-index: 1;">
      Honoraires
    </h1>
  </div>

  <div class="rotate-10 bg-red blur-red p-5 mt-5">
    <div class="m-auto">
      <div class="container col-md-6 py-4 py-md-5 rotate-20 border border-light border-3 row m-auto">
        <p class="h5 text-red text-break text-light text-center py-md-2 px-md-5">

           Prix indicatif de la consultation de 30 mn à 1h : 50 à 75 euros HT
          -<br>
          Si un travail est nécessaire au delà d’une consultation, la convention d’honoraires définit, avec votre accord le prix de l’assistance, du conseil, de la rédaction d’actes juridiques et des plaidoiries.
          Les honoraires sont ajustés en fonction de vos revenus, de la matière ainsi que de la complexité du dossier ou de la procédure. 
        </p>
        <p class="h5 text-red text-break text-light text-center py-md-2 px-md-5">
          Vous avez peut-être une assurance de protection juridique susceptible de couvrir les frais. Qu’est-ce qu’une assurance de protection juridique ?
          <a href="https://www.service-public.fr/particuliers/vosdroits/F3049">https://www.service-public.fr/particuliers/vosdroits/F3049</a>
        </p>
        <p class="h5 text-red text-break text-light text-center py-md-2 px-md-5">
          Si vous n’avez pas d’assurance de protection juridique, il existe l’aide juridictionnelle, qui est une aide financière destinée à toute personne dont les ressources ne dépassent pas un certain montant.
          Pour savoir si vous y avez droit :<a href="https://www.service-public.fr/particuliers/vosdroits/F18074">https://www.service-public.fr/particuliers/vosdroits/F18074</a></p>
        <a href="../../contact.php" class="row pt-md-2 mx-auto"> <button class="text-center bg-beige btn text-red  col-md-4  col-6 rounded-pill border-3 m-auto">Prendre rendez-vous </button> </a>
      </div>
    </div>
</section>

<section id="questions-section" class="py-5 section_juridique" style="overflow: hidden;">
  <div class="titre bg-red wh-100 front py-3">
    <h1 class="text-center" style="z-index: 1;">Questions fréquentes</h1>
  </div>
  <div class="rotate bg-light-90-beige blur-beige" style="overflow: hidden;">
    <div class="container container-lg rotate-minus20">
      <div class="row row-cols-lg-4 row-cols-md-3">
        <?php
        $questions = findAllQuestions($conn);
        foreach ($questions as $question) {
        ?>
          <div class="m-auto py-3">
            <span class="border-4" style="color: #F0C587 !important;">
              <div class="card w-100 bg-wine custom-card">
                <div class="card-header">
                  <h5 class="card-title text-center" style="color:#f5ecd4e9 !important;"><?php echo $question['question']; ?></h5>
                </div>
                <div class="card-body">
                  <h6 class="card-text text-center" style="color:#f5ecd4e9 !important;"><?php echo $question['reponse']; ?></h6>
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