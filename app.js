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
