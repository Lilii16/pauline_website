function validateForm(event) {
    var name = document.getElementById('inputLastName').value;
    var firstName = document.getElementById('first-name').value;
    var email = document.getElementById('inputEmail').value;
    // Ajoutez des validations pour d'autres champs ici...

    var nameRegex = /^[a-zA-ZÀ-ÿ\s\-]+$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!nameRegex.test(name)) {
        alert("Nom invalide");
        event.preventDefault();
        return false;
    }

    if (!nameRegex.test(firstName)) {
        alert("Prénom invalide");
        event.preventDefault();
        return false;
    }

    if (!emailRegex.test(email)) {
        alert("Adresse e-mail invalide");
        event.preventDefault();
        return false;
    }

    // Autres validations pour les autres champs...

    // Si toutes les validations réussissent, le formulaire sera soumis normalement
}

document.getElementById('myForm').addEventListener('submit', validateForm);
