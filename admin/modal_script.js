
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
    } else if (type === 'faq_formation') {
        // Code pour le formulaire d'ajout de FAQ formation
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
function handleView(type, id, question, response) {
    var addForm = document.getElementById('add-form-content');
    addForm.innerHTML = '';

    // Générer le contenu de la modal avec les données de la question et de la réponse
    addForm.innerHTML = `
        <div class="modal-header flex-column">
            <h4 class="modal-title w-100">Question et réponse</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" value="${id}">
            <p><strong>Question:</strong> ${question}</p>
            <p><strong>Réponse:</strong> ${response}</p>
        </div>
    `;
}



// Fonction pour gérer la visualisation
function handleModify(type, id, question, response) {
    var addForm = document.getElementById('add-form-content');
    addForm.innerHTML = '';

    // Générer le contenu de la modal avec les données de la question et de la réponse
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
            <textarea class="form-control" id="ask" name="question" rows="3">${question}</textarea>
        </div>
        <div class="mb-3">
            <label for="msg" class="form-label">Réponse :</label>
            <textarea class="form-control" id="msg" name="reponse" rows="3">${response}</textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Valider les modifications</button>
        </div>
    </form>
</div>

    `;
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
        var question = this.getAttribute('data-question');
        var response = this.getAttribute('data-response');
        var action = this.getAttribute('data-action');

 handleView(type, id, question,response);

        });
        
     
});

// Ajouter des écouteurs d'événements aux boutons de Modifier
triggerBtnsModify.forEach(function(btn) {
    btn.addEventListener('click', function() {
        var type = this.getAttribute('data-type');
        var id = this.getAttribute('data-id');
        var question = this.getAttribute('data-question');
        var response = this.getAttribute('data-response');

 handleModify(type, id, question,response);
 
    });
});
