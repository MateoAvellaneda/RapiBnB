const liPerfil = document.getElementById("liPerfil");
const perfilSubMenu = document.getElementById("perfilSubMenu");

liPerfil.addEventListener("mouseover", function(){
    perfilSubMenu.style.display = "block";
})

liPerfil.addEventListener("mouseout", function(){
    perfilSubMenu.style.display = "none";
})