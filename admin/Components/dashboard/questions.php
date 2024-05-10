<div class="tab-pane fade show active" id="questionsContent" role="tabpanel" aria-labelledby="questions-tab">
                    <!-- Tableau pour afficher les questions -->

                    <!-- dash example -->

                    <div class="card dashcard">
                        <div class="card-header border-bottom d-flex justify-content-between text-light">
                            <h5 class="mb-0">Gestion des question sur conseil juridique</h5>
                            <!-- bouton pour ajouter la question -->

                            <!-- tu travailles ici -->
                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover trigger-btn-add text-light" data-toggle="modal" data-target="#myModal" data-action="ajouter" data-type="question"> <i class="fa fa-plus text-warning" aria-hidden="true"></i>
                                <span>Ajouter un nouveau</span></button>

                            <div class="tri  d-flex justify-content-end">
                                <form action="" method="Post">

                                    <!-- trie des elements -->
                                    <form method="post">
                                        <select name="tri" class="form-select container  justify-content-end bg-duck" aria-label="Default select example" onchange="this.form.submit()">
                                            <option value="">Aucun Trie</option>
                                            <option value="last_modified_date" <?php if (isset($tri) && $tri == 'last_modified_date') echo 'selected="selected"'; ?>>Trier par Date</option>
                                            <option value="question" <?php if (isset($tri) && $tri == 'question') echo 'selected="selected"'; ?>>Trier par Titre</option>
                                        </select>
                                    </form>
                            </div>
                        </div>

                        <div class="table-responsive bg-duck">
                            <table class="table table-nowrap">
                                <thead class="bg-rouille">
                                    <tr class="align-middle">
                                        <th scope="col">Question</th>
                                        <th scope="col">Dernière modification</th>
                                        <th scope="col">Afficher Tout</th>
                                        <th scope="col">Modifier</th>
                                        <th scope="col">Supprimer</th>

                                    </tr>
                                </thead>
                                <tbody> 
                                    <!-- debut boucle -->
                                    <!-- Tableau pour afficher les questions -->
                                  <?php // Utilisation de la fonction pour afficher les questions avec pagination
                                    $items_per_page = 4; // Nombre d'éléments par page
                                    displayQuestionsWithPagination($conn, $tri, $items_per_page);
                                   ?>
                                    <!-- fin boucle -->
                                <!-- </tbody>
                            </table> -->
                            <div class="text-center">

                                <h6> Nombre total d'elements: <?php echo " $nombre_questions"; ?></h6>
                            </div>
                        </div>
                    </div>

                </div>