window.addEventListener("load", function(){
    cargarPublicaciones()
    .then(function(){
        const publicaciones = document.querySelectorAll(".card");
        publicaciones.forEach(publicacion => {
            publicacion.addEventListener("click", function(){
                window.location.replace('http://localhost/RapiBnB/Public/Alquiler/index/?idAlq='+publicacion.id);
            })
        });
    })
})


function cargarPublicaciones(){
    return new Promise((resolve)=>{
        const cardsContainer = document.querySelector(".cardsContainer");
        fetch('http://localhost/RapiBnB/Public/BuscadorAlquileres/getRecomendados'
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                const publicaciones = data.publicaciones;
                publicaciones.forEach(publicacion => {
                    const card = document.createElement("div");
                    card.classList.add("card");
                    const imageCardContainer = document.createElement("div");
                    imageCardContainer.classList.add("imageCardContainer");
                    imagenes = publicacion['fotos'].split(",");
                    imagenes
                    imageCardContainer.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/publicaciones/?direccion='+imagenes[0]+'")';
                    const ciudadCard = document.createElement("p");
                    ciudadCard.classList.add("ciudadCard");
                    ciudadCard.innerHTML = publicacion['ciudad'];
                    const provinciaCard = document.createElement("p");
                    provinciaCard.classList.add("provinciaCard");
                    provinciaCard.innerHTML = publicacion['provincia'];
                    const precioCard = document.createElement("p");
                    precioCard.classList.add("precioCard");
                    precioCard.innerHTML = "$" + publicacion['costoDia'] + " ars por dia";
                    card.setAttribute("id", publicacion['idAlq']);
                    card.appendChild(imageCardContainer);
                    card.appendChild(ciudadCard);
                    card.appendChild(provinciaCard);
                    card.appendChild(precioCard);
                    cardsContainer.appendChild(card);
                }); 
                resolve();
            }
        })
    })
}