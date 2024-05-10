// Fonction pour gérer l'ajout
function handleAdd(type) {
  var addForm = document.getElementById("add-form-content");
  addForm.innerHTML = "";
  document.getElementById("modal-title").innerText ="Ajouter - " +  type;

  // Générer le formulaire d'ajout en fonction du type
  if (type === "question") {
    addForm.innerHTML = `
            <h4>Ajouter</h4>
            <form action="./CRUD/addElement.php" method="post" class="d-flex flex-column justify-content-center align-items-center">
                <input type="hidden" name="type" value="question">
                <label for="question">Question : </label>
                <input type="text" name="question" class="form-control shadow rounded-3"><br>
                <label for="reponse">Réponse : </label>
                <textarea name="reponse" style="height: 150px" class="form-control shadow rounded-3 "></textarea><br>
                <button type="submit" class="btn btn-danger col-6 mb-3">Ajouter</button>
            </form>
        `;
  } else if (type === "article") {
    // Code pour le formulaire d'ajout d'article
    addForm.innerHTML = `
                     <form action="./CRUD/addElement.php" method="post" class="d-flex flex-column justify-content-center align-items-center">
                         <input type="hidden" name="type" value="article">
                         <label for="title">Titre : </label>
                         <input type="text"  class="form-control shadow rounded-3" name="title"><br>
                         <label for="origine">Lien : </label>
                         <input type="text"   class="form-control shadow rounded-3" name="origine"><br>
                         <label for="deskription">Description : </label>
                         <textarea name="deskription"  class="form-control shadow rounded-3" style="height: 100px"></textarea><br>
                         <button type="submit" class="btn btn-danger col-6 mb-3">Ajouter</button>
                     </form>
                 `;
  } else if (type === "publication") {
    // Code pour le formulaire d'ajout de publication
    addForm.innerHTML = ` 
    <!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
        <form enctype="multipart/form-data" action="./CRUD/addElement.php"  method="post" class="d-flex flex-column justify-content-center align-items-center">
        <!-- Autres champs du formulaire pour ajouter un article -->
        <input type="hidden" name="type" value="publication">
        <label for="titre">Titre : </label>
        <input type="text"  class="form-control shadow rounded-3" name="titre"><br>
        <label for="description">Description : </label>
        <textarea name="description"  class="form-control shadow rounded-3" style="height: 100px"></textarea><br>
        <label for="source">Source : </label>
        <input type="text"  class="form-control shadow rounded-3" name="source"><br>
        <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
        <label for="path">Fichier : </label>
        <input type="file"  class="form-control shadow rounded-3" name="path"><br>
        <button type="submit" class="btn btn-danger col-6 mb-3">Ajouter</button>
    </form>`;
  } else if (type === "faq_formation") {
    // Code pour le formulaire d'ajout de FAQ formation
    addForm.innerHTML = `
        <form action="./CRUD/addElement.php" method="post" class="d-flex flex-column justify-content-center align-items-center"><br>
        <input type="hidden" name="type" value="faq_formation">
        <label for="question">Question : </label>
        <input type="text"  class="form-control shadow rounded-3" name="question"><br>
        <label for="reponse">Réponse : </label>
        <textarea name="reponse"  class="form-control shadow rounded-3"style="height: 100px"></textarea><br>
        <button type="submit" class="btn btn-danger col-6 mb-3">Ajouter</button>
    </form>`;
  } else {
    // Redirection en cas de type invalide
    console.log("Type invalide");
  }
}

// Fonction pour gérer la suppression
function handleDelete(type, id) {
  var addForm = document.getElementById("add-form-content");
  addForm.innerHTML = "";
  document.getElementById("modal-title").innerText ="Supprimer - " +  type;

  // Générer le formulaire de suppression
  addForm.innerHTML = `
        <div class="modal-header flex-column">
            <h4 class="modal-title w-100">Êtes-vous sûr de vouloir supprimer?</h4>
        </div>
        <div class="modal-body">
            <p>Êtes-vous vraiment sûr de vouloir supprimer cet élément ?</p>
            <form id="delete-form" action="./CRUD/deletedElement.php" method="post" class="d-flex justify-content-center">
                <input type="hidden" name="id" value="${id}">
                <input type="hidden" name="type" value="${type}">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    `;
}

// Fonction pour gérer la visualisation
function handleView(type, id, title, description, lien,source) {
  var addForm = document.getElementById("add-form-content");
  addForm.innerHTML = "";
  document.getElementById("modal-title").innerText ="Visualiser - " +  type;

  // Générer le contenu de la modal avec les données de la question et de la réponse
  if (type === "question") {
    addForm.innerHTML = `
        <div class="modal-header flex-column">
            <h4 class="modal-title w-100">Question et réponse</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" value="${id}">
            <p><strong>Question:</strong></p>
            <p> ${title}</p>
            <p><strong>Réponse:</strong></p>
            <p> ${description}</p>
        </div>
    `;
  } else if (type === "article") {
    addForm.innerHTML = `
        <div class="modal-header flex-column">
        <h4 class="modal-title w-100">Question et réponse</h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value="${id}">
        <p><strong>Titre:</strong></p>
        <p> ${title}</p>
        <p><strong>Description:</strong></p>
        <p>  ${description}</p>
        <p><strong>Lien:</strong></p>
        <p> ${lien}</p>
    </div>`;
  } else if (type === "publication") {
    addForm.innerHTML = `
        <div class="modal-header flex-column">
        <h4 class="modal-title w-100">Question et réponse</h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value="${id}">
        <p><strong>Titre:</strong></p>
        <p>> ${title}</p>
        <p><strong>Description:</strong></p>
        <p> ${description}</p>
        <p><strong>Source:</strong></p>
        <p> ${source}</p>
        <a href="${lien}" class="btn rounded-pill bg-primary text-light m-2 p-1" download>Telecharger</a>
    </div>`;
  } else if (type === "faq_formation") {
    addForm.innerHTML = `
        <div class="modal-header flex-column">
            <h4 class="modal-title w-100">Question et réponse</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" value="${id}">
            <p><strong>Question:</strong></p>
            <p>> ${title}</p>
            <p><strong>Réponse:</strong> ${description}</p>
            <p>> ${description}</p>
        </div>
    `;
  }
}

// Fonction pour gérer la visualisation
function handleModify(type, id, title, description, lien,source) {
  var addForm = document.getElementById("add-form-content");
  addForm.innerHTML = "";
  document.getElementById("modal-title").innerText ="Modification - " +  type;

  // Générer le contenu de la modal avec les données de la question et de la réponse
  if (type === "question") {
    addForm.innerHTML = `
    <div class="modal-header flex-column">
    <h4 class="modal-title w-100">Question et réponse</h4>
</div>
<div class="modal-body">
    <form action="./CRUD/updateElement.php" method="post">
        <input type="hidden" name="type" value="${type}">
        <input type="hidden" name="id" value="${id}">
        <div class="mb-3">
            <label for="ask" class="form-label">Question :</label>
            <textarea class="form-control" id="ask" name="question" rows="3">${title}</textarea>
        </div>
        <div class="mb-3">
            <label for="msg" class="form-label">Réponse :</label>
            <textarea class="form-control" id="msg" name="reponse" rows="10" style="height=fit-content">${description}</textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Valider les modifications</button>
        </div>
    </form>
</div>

    `;
  } else if (type === "article") {
    addForm.innerHTML = `
    <div class="modal-header flex-column">
    <h4 class="modal-title w-100">Question et réponse</h4>
</div>
<div class="modal-body">
    <form action="./CRUD/updateElement.php" method="post">
        <input type="hidden" name="type" value="${type}">
        <input type="hidden" name="id" value="${id}">

        <div class="mb-3">
            <label for="title" class="form-label">Titre :</label>
            <textarea id="title" name="title" class="form-control">${title}</textarea>
        </div>

        <div class="mb-3">
            <label for="origine" class="form-label">Lien :</label>
            <textarea id="origine" name="origine" class="form-control">${lien}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="deskription" class="form-label">Description :</label>
            <textarea id="deskription" name="deskription" class="form-control" rows="6">${description}</textarea>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Valider les modifications</button>
        </div>
    </form>
</div>

`;
  } else if (type === "publication") {
    addForm.innerHTML = `   
    <form enctype="multipart/form-data"  action="./CRUD/updateElement.php" method="post">
    <input type="hidden" name="type" value="${type}">
    <input type="hidden" name="id" value="${id}">
    
    <div class="mb-3">
        <label for="titre" class="form-label">Titre :</label>
        <textarea id="titre" name="titre" class="form-control rows="6">${title}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Description :</label>
        <textarea id="description" name="description" class="form-control" rows="8">${description}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="source" class="form-label">Source :</label>
        <textarea id="source" name="source" class="form-control">${source}</textarea>
    </div>
    <div class="mb-3">
    <label for="path" class="form-label col-12">Visualiser le fichier :</label>
    <a href="${lien}" class="btn rounded-2 bg-primary text-red text-light m-3 p-1 col-4" download>Télecharger</a>
    <textarea id="path" name="path" class="form-control">${lien}</textarea>
</div>
    <div class="mb-3">
    <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
    <label for="new_path">Choisir un autre fichier : </label>
    <input type="file"  class="form-control shadow rounded-3" name="new_path"><br>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Valider les modifications</button>
    </div>
</form>
`;
  } else if (type === "faq_formation") {
    addForm.innerHTML = `
        <div class="modal-header flex-column">
        <h4 class="modal-title w-100">Question et réponse</h4>
    </div>
    <div class="modal-body">
        <form action="./CRUD/updateElement.php" method="post">
            <input type="hidden" name="type" value="faq_formation">
            <input type="hidden" name="id" value="${id}">
            <div class="mb-3">
                <label for="ask" class="form-label">Question :</label>
                <textarea class="form-control" id="ask" name="question" rows="3">${title}</textarea>
            </div>
            <div class="mb-3">
                <label for="msg" class="form-label">Réponse :</label>
                <textarea class="form-control" id="msg" name="reponse" rows="10">${description}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Valider les modifications</button>
            </div>
        </form>
    </div>`;
  }
}

// Récupérer les boutons d'ajout et de suppression
var triggerBtnsAdd = document.querySelectorAll(".trigger-btn-add");
var triggerBtnsDelete = document.querySelectorAll(".trigger-btn-delete");
var triggerBtnsView = document.querySelectorAll(".trigger-btn-view");
var triggerBtnsModify = document.querySelectorAll(".trigger-btn-modify");

// Ajouter des écouteurs d'événements aux boutons d'ajout
triggerBtnsAdd.forEach(function (btn) {
  btn.addEventListener("click", function () {
    var type = this.getAttribute("data-type");
    handleAdd(type);
  });
});

// Ajouter des écouteurs d'événements aux boutons de suppression
triggerBtnsDelete.forEach(function (btn) {
  btn.addEventListener("click", function () {
    var type = this.getAttribute("data-type");
    var id = this.getAttribute("data-id");
    handleDelete(type, id);
  });
});

// Ajouter des écouteurs d'événements aux boutons de view
triggerBtnsView.forEach(function (btn) {
  btn.addEventListener("click", function () {
    var type = this.getAttribute("data-type");
    var id = this.getAttribute("data-id");
    // var question = this.getAttribute('data-question');
    // var response = this.getAttribute('data-response');
    var title = this.getAttribute("data-title");
    var description = this.getAttribute("data-description");
    var lien = this.getAttribute("data-lien");
    var source = this.getAttribute("data-source");
    handleView(type, id, title, description, lien, source);
  });
});

// Ajouter des écouteurs d'événements aux boutons de Modifier
triggerBtnsModify.forEach(function (btn) {
  btn.addEventListener("click", function () {
    var type = this.getAttribute("data-type");
    var id = this.getAttribute("data-id");
    var title = this.getAttribute("data-title");
    var description = this.getAttribute("data-description");
    var lien = this.getAttribute("data-lien");
    var source = this.getAttribute("data-source");
    handleModify(type, id, title, description, lien, source);
  });
});

