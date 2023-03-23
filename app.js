var dropdown = document.querySelector(".dropdown");
var content = document.querySelector(".dropdown-content");
dropdown.addEventListener("click", function() {
  content.classList.toggle("hidden");
});

var menu = document.getElementById("mon-menu");
menu.addEventListener("change", function() {
  var selectedOption = this.options[this.selectedIndex];
  window.location.href = selectedOption.value;
});
var content = document.querySelector(".dropdown-content");
var links = content.querySelectorAll(".dropdown-link");
var maxHeight = 0;
for (var i = 0; i < links.length; i++) {
  maxHeight += links[i].offsetHeight;
}
content.style.maxHeight = maxHeight + "px";

function validerFormulaire() {
  var nom = document.getElementById("nom").value;
  var email = document.getElementById("email").value;
  var mdp = document.getElementById("mdp").value;
  
  if (nom == "" || email == "" || mdp == "") {
    alert("Veuillez remplir tous les champs");
    return false; // empêche l'envoi du formulaire si des champs sont vides
  }
  
  return true; // autorise l'envoi du formulaire si tous les champs sont remplis
}