function hideSuccessMessage() {
    // Sélectionne l'élément contenant le message de succès
    var successMessage = document.querySelector('.session');

    // Si l'élément existe
    if (successMessage) {
        // Masque l'élément après 3 secondes
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 6000); // 6sec
    }
}
