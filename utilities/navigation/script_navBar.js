// navbar changement border couleur
// recuperer les id des liens et du bord a changer
var border = document.getElementById("border");
var links = document.querySelectorAll(".link");

links.forEach(
    function(link) {
    link.addEventListener("mouseover", function() {
        border.style.border = "2px solid #0010a3";
    });

    link.addEventListener("mouseout", function() {
        border.style.border = "2px solid #f5ecd4";
    });
});