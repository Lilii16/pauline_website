
            // Fonction pour récupérer les données lors du clic sur le bouton de suppression et d'ajout
            var triggerBtns = document.querySelectorAll('.trigger-btn');


            triggerBtns.forEach(function(btn) {

                btn.addEventListener('click', function() {
                    var type = this.getAttribute('data-type');
                    var id = this.getAttribute('data-id');
                    var action = this.getAttribute('data-action');
                    var addForm = document.getElementById('add-form-content');
                        addForm.innerHTML = ''; 

                  if(action === 'delete'){
                        // Si le type n'est pas "ajout", traiter comme la suppression
                        document.getElementById('delete-type').value = type;
                        document.getElementById('delete-id').value = id;
                        console.log("Type invalide");
                    } else if(action === 'modifier'){
                    
                       
                    } else if(action === 'afficher'){
                        var addForm = document.getElementById('add-form-content');
                        addForm.innerHTML = ''; // Efface tout contenu précédent
                        if (type === 'question') {
                            addForm.innerHTML = `
                            <h2>visualiser</h2>
                <form action="updateElement.php" method="post" class="row justify-content-center col-6">
                    <input type="hidden" name="type" value="question">
                    <label for="question">Question :  <?= isset($question['question']) ? $question['question'] : '' ?></label>
                    <textarea name="question" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= isset($question['question']) ? $question['question'] : '' ?></textarea> <br>
                    <label for="reponse">Réponse : </label>
                    <textarea name="reponse" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea><br>
                    <input type="submit" value="Valider"><br>
                </form>
            `;
        } else if (type === 'article') {
            document.write(`
            <h2>visualiser</h2>
                <form action="updateElement.php" method="post">
                    <input type="hidden" name="type" value="article">
                    <input type="hidden" name="id" value="${article && article.id ? article.id : ''}">
                    <ul>
                        <li>
                            <label for="title">Titre : </label>
                            <textarea id="title" name="title">${article && article.title ? article.title : ''}</textarea>
                        </li>
                        <li>
                            <label for="origine">Lien : </label>
                            <textarea id="origine" name="origine">${article && article.origine ? article.origine : ''}</textarea>
                        </li>
                        <li>
                            <label for="deskription">Description: </label>
                            <textarea id="deskription" name="deskription">${article && article.deskription ? article.deskription : ''}</textarea>
                        </li>
                        <li>
                            <div class="button">
                                <button type="submit">Valider les modifications</button>
                            </div>
                        </li>
                    </ul>
                </form>
            `);
        } else if (type === 'publication') {
            document.write(`
                <form action="updateElement.php" method="post">
                    <input type="hidden" name="type" value="publication">
                    <input type="hidden" name="id" value="${publication && publication.id ? publication.id : ''}">
                    <ul>
                        <li>
                            <label for="titre">Titre : </label>
                            <textarea id="titre" name="titre">${publication && publication.titre ? publication.titre : ''}</textarea>
                        </li>
                        <li>
                            <label for="description">Description: </label>
                            <textarea id="description" name="description">${publication && publication.description ? publication.description : ''}</textarea>
                        </li>
                        <li>
                            <label for="source">Source : </label>
                            <textarea id="source" name="source">${publication && publication.source ? publication.source : ''}</textarea>
                        </li>
                        <li>
                            <label for="lien">Lien : </label>
                            <textarea id="lien" name="lien">${publication && publication.lien ? publication.lien : ''}</textarea>
                        </li>
                        <li>
                            <div class="button">
                                <button type="submit">Valider les modifications</button>
                            </div>
                        </li>
                    </ul>
                </form>
            `);
        } else if (type === 'faq_formation') {
            document.write(`
                <form action="update.php" method="post">
                    <input type="hidden" name="type" value="faq_formation">
                    <input type="hidden" name="id" value="${faq_formation && faq_formation.id ? faq_formation.id : ''}">
                    <ul>
                        <li>
                            <label for="ask">Question : </label>
                            <textarea id="ask" name="question">${faq_formation && faq_formation.question ? faq_formation.question : ''}</textarea>
                        </li>
                        <li>
                            <label for="msg">Réponse : </label>
                            <textarea id="msg" name="reponse">${faq_formation && faq_formation.reponse ? faq_formation.reponse : ''}</textarea>
                        </li>
                        <li>
                            <div class="button">
                                <button type="submit">Valider les modifications</button>
                            </div>
                        </li>
                    </ul>
                </form>
            `);
        } else {
            // Redirect or handle invalid type
            console.log(type);
            // window.location.href = '../dashboard.php';
        }

                    } else {
                        console.log("oups");
                    }
                });
            });
  


            <!-- Modal HTML pour supprimer les elements -->
            <div class="modal fade" id="myModalelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header flex-column">
                            <!-- <div class="icon-box">
                                <i class="material-icons">&#10006;</i>
                            </div> -->
                            <!-- dynamiser -->
                            <h4 class="modal-title w-100">Êtes-vous sûr de vouloir supprimer?</h4>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                        </div>
        
                        <div class="modal-body">
        <!-- dynamiser -->
                            <p>Êtes-vous vraiment sûr de vouloir supprimer cet élément ?</p>
        
        
                        </div>
        
        <!-- dynamiser -->
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <form id="delete-form" action="./CRUD/deletedElement.php" method="post" class="row justify-content-center col-6">
                                <input type="hidden" name="id" id="delete-id">
                                <input type="hidden" name="type" id="delete-type">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        
<!-- <script>
        // Fonction pour récupérer les données lors du clic sur le bouton d'ajouter
        var triggerBtns = document.querySelectorAll('.trigger-btn');

        triggerBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var type = this.getAttribute('data-type');
                var id = this.getAttribute('data-id');
                document.getElementById('delete-type').value = type;
                document.getElementById('delete-id').value = id;
            });
        });
    </script> -->

    