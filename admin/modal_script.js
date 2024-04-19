
// Fonction pour gérer l'ajout
function handleAdd(type) {
    var addForm = document.getElementById('add-form-content');
    addForm.innerHTML = '';

    // Générer le formulaire d'ajout en fonction du type
    if (type === 'question') {
        addForm.innerHTML = `
            <h2>Ajouter</h2>
            <form action="./CRUD/addElement.php" method="post" class="d-flex flex-column justify-content-center align-items-center">
                <input type="hidden" name="type" value="question">
                <label for="question">Question : </label>
                <input type="text" name="question"><br>
                <label for="reponse">Réponse : </label>
                <textarea name="reponse" style="height: 100px"></textarea><br>
                <button type="submit" class="btn btn-danger">Ajouter</button>
            </form>
        `;
    } else if (type === 'article') {
        // Code pour le formulaire d'ajout d'article
        addForm.innerHTML = `
                     <form action="addElement.php" method="post" class="d-flex flex-column justify-content-center align-items-center">
                         <input type="hidden" name="type" value="article">
                         <label for="title">Titre : </label>
                         <input type="text" name="title"><br>
                         <label for="origine">Lien : </label>
                         <input type="text" name="origine"><br>
                         <label for="deskription">Description : </label>
                         <textarea name="deskription" style="height: 100px"></textarea><br>
                         <input type="submit" value="Ajouter"><br>
                     </form>
                 `;
    } else if (type === 'publication') {
        // Code pour le formulaire d'ajout de publication
        addForm.innerHTML =` 
        <form action="addElement.php" method="post" class="d-flex flex-column justify-content-center align-items-center">
        <!-- Autres champs du formulaire pour ajouter un article -->
        <input type="hidden" name="type" value="publication">
        <label for="titre">Titre : </label>
        <input type="text" name="titre"><br>
        <label for="description">Description : </label>
        <textarea name="description" style="height: 100px"></textarea><br>
        <label for="source">Source : </label>
        <input type="text" name="source"><br>
        <label for="lien">Lien : </label>
        <input type="text" name="lien"><br>
        <!-- Ajoutez d'autres champs pour les articles si nécessaire -->
        <input type="submit" value="Ajouter"><br>
    </form>`
    } else if (type === 'faq_formation') {
        // Code pour le formulaire d'ajout de FAQ formation
        addForm.innerHTML =`
        <form action="addElement.php" method="post" class="d-flex flex-column justify-content-center align-items-center"><br>
        <input type="hidden" name="type" value="faq_formation">
        <label for="question">Question : </label>
        <input type="text" name="question"><br>
        <label for="reponse">Réponse : </label>
        <textarea name="reponse" style="height: 100px"></textarea><br>
        <input type="submit" value="Ajouter"><br>
    </form>`
    } else {
        // Redirection en cas de type invalide
        console.log("Type invalide");
    }
}

// Fonction pour gérer la suppression
function handleDelete(type, id) {
    var addForm = document.getElementById('add-form-content');
    addForm.innerHTML = '';

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
function handleView(type, id, title,description,lien) {
    var addForm = document.getElementById('add-form-content');
    addForm.innerHTML = '';

    // Générer le contenu de la modal avec les données de la question et de la réponse
    if(type === "question"){
          addForm.innerHTML = `
        <div class="modal-header flex-column">
            <h4 class="modal-title w-100">Question et réponse</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" value="${id}">
            <p><strong>Question:</strong> ${title}</p>
            <p><strong>Réponse:</strong> ${description}</p>
        </div>
    `;  
    } else if(type === "article"){
        addForm.innerHTML = `
        <div class="modal-header flex-column">
        <h4 class="modal-title w-100">Question et réponse</h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value="${id}">
        <p><strong>Titre:</strong> ${title}</p>
        <p><strong>Description:</strong> ${description}</p>
        <p><strong>Lien:</strong> ${lien}</p>
    </div>`
    } else if(type ==="publication"){
        addForm.innerHTML = `
        <div class="modal-header flex-column">
        <h4 class="modal-title w-100">Question et réponse</h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value="${id}">
        <p><strong>Question:</strong> ${title}</p>
        <p><strong>Question:</strong> ${description}</p>
        <p><strong>Réponse:</strong> ${lien}</p>
    </div>`
    } else if (type === "faq_formation"){
        addForm.innerHTML = `
        <div class="modal-header flex-column">
            <h4 class="modal-title w-100">Question et réponse</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" value="${id}">
            <p><strong>Question:</strong> ${title}</p>
            <p><strong>Réponse:</strong> ${description}</p>
        </div>
    `;  
    }

}



// Fonction pour gérer la visualisation
function handleModify(type, id,  title,description,lien) {
    var addForm = document.getElementById('add-form-content');
    addForm.innerHTML = '';

    // Générer le contenu de la modal avec les données de la question et de la réponse
    if(type === "question"){
            addForm.innerHTML = `
    <div class="modal-header flex-column">
    <h4 class="modal-title w-100">Question et réponse</h4>
</div>
<div class="modal-body">
    <form action="./CRUD/updateElement.php" method="post">
        <input name="type" value="${type}">
        <input type="hidden" name="id" value="${id}">
        <div class="mb-3">
            <label for="ask" class="form-label">Question :</label>
            <textarea class="form-control" id="ask" name="question" rows="3">${title}</textarea>
        </div>
        <div class="mb-3">
            <label for="msg" class="form-label">Réponse :</label>
            <textarea class="form-control" id="msg" name="reponse" rows="3">${description}</textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Valider les modifications hey</button>
        </div>
    </form>
</div>

    `;
    } else if(type === "article") {
        addForm.innerHTML = `
        <!-- Formulaire pour modifier un article -->
        <form action="updateElement.php" method="post">
        <input type="hidden" name="type" value="${type}">
        <input type="hidden" name="id" value="${id}">
        <ul>
            <li>
                <label for="title">Titre : </label>
                <textarea id="title" name="title">${title}</textarea>
            </li>
            <li>
                <label for="origine">Lien : </label>
                <textarea id="origine" name="origine">${lien}</textarea>
            </li>
            <li>
                <label for="deskription">Description: </label>
                <textarea id="deskription" name="deskription">${description}textarea>
            </li>
            <li>
                <div class="button">
                    <button type="submit">Valider les modifications</button>
                </div>
            </li>
        </ul>
    </form>`
    } else if(type === "publication") {
        addForm.innerHTML = `     <form action="updateElement.php" method="post">
        <input type="hidden" name="type" value="${type}">
        <input type="hidden" name="id" value="${id}">
        <ul>
            <li>
                <label for="titre">Titre : </label>
                <textarea id="titre" name="titre">${title}</textarea>
            </li>
            <li>
                <label for="description">Description: </label>
                <textarea id="description" name="description">${description}</textarea>
            </li>
            <li>
                <label for="source">Source : </label>
                <textarea id="source" name="source">${lien}</textarea>
            </li>
            <li>
                <label for="lien">Lien : </label>
                <textarea id="lien" name="lien">${lien}</textarea>
            </li>
            <li>
                <div class="button">
                    <button type="submit">Valider les modifications</button>
                </div>
            </li>
        </ul>
    </form>`
    } else if(type === "faq_formation") {
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
                <textarea class="form-control" id="msg" name="reponse" rows="3">${description}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Valider les modifications</button>
            </div>
        </form>
    </div>`
    } 
}


// Récupérer les boutons d'ajout et de suppression
var triggerBtnsAdd = document.querySelectorAll('.trigger-btn-add');
var triggerBtnsDelete = document.querySelectorAll('.trigger-btn-delete');
var triggerBtnsView = document.querySelectorAll('.trigger-btn-view');
var triggerBtnsModify = document.querySelectorAll('.trigger-btn-modify');

// Ajouter des écouteurs d'événements aux boutons d'ajout
triggerBtnsAdd.forEach(function(btn) {
    btn.addEventListener('click', function() {
        var type = this.getAttribute('data-type');
        handleAdd(type);
    });
});

// Ajouter des écouteurs d'événements aux boutons de suppression
triggerBtnsDelete.forEach(function(btn) {
    btn.addEventListener('click', function() {
        var type = this.getAttribute('data-type');
        var id = this.getAttribute('data-id');
        handleDelete(type, id);
    });
});

// Ajouter des écouteurs d'événements aux boutons de view
triggerBtnsView.forEach(function(btn) {
    btn.addEventListener('click', function() {
        var type = this.getAttribute('data-type');
        var id = this.getAttribute('data-id');
        // var question = this.getAttribute('data-question');
        // var response = this.getAttribute('data-response');
        var title = this.getAttribute('data-title');
        var description = this.getAttribute('data-description');
        var lien = this.getAttribute('data-lien');
 handleView(type, id,title,description,lien);

        });
        
     
});

// Ajouter des écouteurs d'événements aux boutons de Modifier
triggerBtnsModify.forEach(function(btn) {
    btn.addEventListener('click', function() {
        var type = this.getAttribute('data-type');
        var id = this.getAttribute('data-id');
        var title = this.getAttribute('data-title');
        var description = this.getAttribute('data-description');
        var lien = this.getAttribute('data-lien');
 handleModify(type, id, title,description,lien);
 
    });
});
