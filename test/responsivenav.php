  <!-- responsive sidebar -->

  <nav class="navbar bg-wine navbar-expand-lg col-lg-2 container-fluid">
                <!-- Sidebar -->
                <div class="collapse navbar-collapse flex-lg-column col-6 vh-lg-100 " id="sidebar">
                    <ul class="navbar-nav nav nav-pills flex-lg-column mb-auto  ">
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <!-- Votre contenu de la sidebar ici -->
                                <span class="fs-4 text-light">
                                    <?php output_username(); ?>
                                </span>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link link-light text-center">
                                Visualiser le site
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-beige active " id="questions-tab" data-toggle="tab" href="#questionsContent" role="tab" aria-controls="questions" aria-selected="false">Questions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  link-beige" id="articles-tab" data-toggle="tab" href="#articlesContent" role="tab" aria-controls="articles" aria-selected="false">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  link-beige" id="publications-tab" data-toggle="tab" href="#publicationsContent" role="tab" aria-controls="publications" aria-selected="false">Publications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  link-beige" id="faq-formation-tab" data-toggle="tab" href="#faq-formationContent" role="tab" aria-controls="faq-formation" aria-selected="false">FAQ-formations</a>
                        </li>
                        <hr>

                    </ul>
                    <hr>
                    <hr>
                    <div class="dropdown dropup">
                        <a href="#" class="d-flex align-items-center link-beige text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets/logos/logoFond.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>Pauline</strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="#">Nous contacter</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li> <a class="dropdown-item text-danger" href="./login/logout.php">Se déconnecter</a></li>

                        </ul>
                    </div>
                </div>

                <!-- Bouton de menu burger pour les appareils mobiles -->
                <button class="navbar-toggler fixed-top fixed-left bg-wine col-1" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </nav>