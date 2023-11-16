

window.addEventListener("DOMContentLoaded", function () {
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);
    if(params.has("titulo") && params.has("etiquetas[]") && params.has("SelectorProvincia")){
        generarPaginacionForm(params.get("titulo"),params.getAll("etiquetas[]"),params.get("SelectorProvincia"))
        .then(()=>{
            
            const pageNumbers = document.querySelectorAll(".page-number");
            pageNumbers.forEach((pageNumber) => {
                pageNumber.addEventListener("click", function(event){
                    if(!pageNumber.classList.contains("paginaSeleccionada")){
                    const cardsAlquileresContainer = document.getElementById('cardsAlquileresContainer');
                    const paginaActual = document.querySelector(".paginaSeleccionada");
                    paginaActual.classList.remove("paginaSeleccionada");
                    cardsAlquileresContainer.innerHTML = "";
                    pageNumber.classList.add("paginaSeleccionada");
                    cargarContenidoDePaginaForm(parseInt(pageNumber.textContent, 10),params.get("titulo"),params.getAll("etiquetas[]"),params.get("SelectorProvincia"))
                    .then(()=>{
                        const cardsAlquileres = this.document.querySelectorAll(".cardAlquiler");
                        cardsAlquileres.forEach((cardAlquiler)=>{
                            cardAlquiler.addEventListener("click", function(){
                                window.location.replace('http://localhost/RapiBnB/Public/Alquiler/index/?idAlq='+cardAlquiler.id);
                            })
                        })
                    })
                    }
                })
      
            })
        })
        
        .catch(error => {
            console.error("Error en generarPaginacion:", error);
        });
        cargarContenidoDePaginaForm(1, params.get("titulo"),params.getAll("etiquetas[]"),params.get("SelectorProvincia"))
        .then(()=>{
            const cardsAlquileres = this.document.querySelectorAll(".cardAlquiler");
            cardsAlquileres.forEach((cardAlquiler)=>{
                cardAlquiler.addEventListener("click", function(){
                    window.location.replace('http://localhost/RapiBnB/Public/Alquiler/index/?idAlq='+cardAlquiler.id);
                })
            })
        })
    }else{
        generarPaginacionAll()
        .then(()=>{
            
            const pageNumbers = document.querySelectorAll(".page-number");
            pageNumbers.forEach((pageNumber) => {
                pageNumber.addEventListener("click", function(event){
                    if(!pageNumber.classList.contains("paginaSeleccionada")){
                    const cardsAlquileresContainer = document.getElementById('cardsAlquileresContainer');
                    const paginaActual = document.querySelector(".paginaSeleccionada");
                    paginaActual.classList.remove("paginaSeleccionada");
                    cardsAlquileresContainer.innerHTML = "";
                    pageNumber.classList.add("paginaSeleccionada");
                    cargarContenidoDePaginaAll(parseInt(pageNumber.textContent, 10))
                    .then(()=>{
                        const cardsAlquileres = document.querySelectorAll(".cardAlquiler");
                        cardsAlquileres.forEach((cardAlquiler)=>{
                            cardAlquiler.addEventListener("click", function(){
                                window.location.replace('http://localhost/RapiBnB/Public/Alquiler/index/?idAlq='+cardAlquiler.id);
                            })
                        })
                    })
                    }
              
                })
      
            })
        })
        .catch(error => {
            console.error("Error en generarPaginacion:", error);
        });
        cargarContenidoDePaginaAll(1)
        .then(()=>{
            const cardsAlquileres = this.document.querySelectorAll(".cardAlquiler");
            cardsAlquileres.forEach((cardAlquiler)=>{
                cardAlquiler.addEventListener("click", function(){
                    window.location.replace('http://localhost/RapiBnB/Public/Alquiler/index/?idAlq='+cardAlquiler.id);
                })
            })
        })
    }
    

});


  function generarPaginacionAll(){
    return new Promise((resolve, reject) =>{
        fetch('http://localhost/RapiBnB/Public/BuscadorAlquileres/cantidadAlquileres',{method: 'GET'}
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                const itemsPorPagina = 12;
                const totalItems = data.cantidad;
                const totalPages = Math.ceil(totalItems / itemsPorPagina);
                const paginacion = document.getElementById("paginacion");
                for (let i = 1; i <= totalPages; i++) {
                    const pageNumber = document.createElement("span");
                    pageNumber.textContent = i;
                    pageNumber.classList.add("page-number");
                    paginacion.appendChild(pageNumber);
                }
                const primerNumero = paginacion.querySelector(":first-child");
                primerNumero.classList.add("paginaSeleccionada");
                resolve();
            }else{
                reject("Error en la respuesta de cantidadAlquileres");
            }
        }).catch(error => {
            reject("Error al enviar la solicitud:" + error);
          });
    })
    
  }

  function cargarContenidoDePaginaAll(pageNumber){
    return new Promise((resolve, reject) =>{
        fetch('http://localhost/RapiBnB/Public/BuscadorAlquileres/extraerAlquileres/?limit=12&page='+pageNumber,{method: 'GET'}
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
            if(data.alquileres != null){
                const alquileres = data.alquileres;
                const cardsAlquileresContainer = document.getElementById('cardsAlquileresContainer');
                alquileres.forEach(function(element){
                    const cardAlquiler = document.createElement('div');
                    cardAlquiler.classList.add("cardAlquiler");
                    const imagenBackground = document.createElement('div');
                    imagenBackground.classList.add("imagenBackground");
                    const imagenes = element['fotos'].split(",");
                    imagenBackground.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/publicaciones/?direccion='+imagenes[0]+'")';
                    cardAlquiler.appendChild(imagenBackground);
                    const ciudad = document.createElement('p');
                    ciudad.classList.add("cardTextCiudad");
                    ciudad.textContent = element['ciudad'];
                    cardAlquiler.appendChild(ciudad);
                    const provincia = document.createElement('p');
                    provincia.classList.add("cardTextProvincia");
                    provincia.textContent = element['provincia'];
                    cardAlquiler.appendChild(provincia);
                    const precio = document.createElement('p');
                    precio.classList.add('cardTextPrecio');
                    precio.textContent = "$" + element['costoDia'] + " ars por dia";
                    cardAlquiler.appendChild(precio);
                    cardAlquiler.setAttribute("id", element['idAlq']);
                    if(element['verificado']){
                        const verif = document.createElement("p");
                        verif.classList.add("verif");
                        verif.innerHTML = "<i class='bi bi-patch-check-fill'></i> Verificado";
                        cardAlquiler.appendChild(verif);
                    }
                    cardsAlquileresContainer.appendChild(cardAlquiler);
                });
            }
            resolve();
            }else{
                reject("Error en la respuesta de extraerAlquileres");
            }
        }).catch(error => {
            console.error('Error al enviar la solicitud:', error);
            reject("Error en la respuesta de extraerAlquileres:" + error);
        });
    })
  }


  function generarPaginacionForm(titulo, etiquetas, provincia){
    return new Promise((resolve, reject) =>{
        fetch('http://localhost/RapiBnB/Public/BuscadorAlquileres/cantidadAlquileresForm/?titulo='+titulo+'&etiquetas[]='+etiquetas.join("&etiquetas[]=")+'&SelectorProvincia='+provincia,{method: 'GET'}
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                const itemsPorPagina = 12;
                const totalItems = data.cantidad;
                const totalPages = Math.ceil(totalItems / itemsPorPagina);
                const paginacion = document.getElementById("paginacion");
                for (let i = 1; i <= totalPages; i++) {
                    const pageNumber = document.createElement("span");
                    pageNumber.textContent = i;
                    pageNumber.classList.add("page-number");
                    paginacion.appendChild(pageNumber);
                }
                const primerNumero = paginacion.querySelector(":first-child");
                primerNumero.classList.add("paginaSeleccionada");
                resolve();
            }else{
                reject("Error en la respuesta de cantidadAlquileres");
            }
        }).catch(error => {
            reject("Error al enviar la solicitud:" + error);
          });
    })
  }

  function cargarContenidoDePaginaForm(pageNumber, titulo, etiquetas, provincia){
    return new Promise((resolve, reject) =>{
        fetch('http://localhost/RapiBnB/Public/BuscadorAlquileres/extraerAlquileresForm/?limit=12&page='+pageNumber+'&titulo='+titulo+'&etiquetas[]='+etiquetas.join("&etiquetas[]=")+'&SelectorProvincia='+provincia,{method: 'GET'}
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
            if(data.alquileres != null){
                const alquileres = data.alquileres;
                const cardsAlquileresContainer = document.getElementById('cardsAlquileresContainer');
                alquileres.forEach(function(element){
                    const cardAlquiler = document.createElement('div');
                    cardAlquiler.classList.add("cardAlquiler");
                    const imagenBackground = document.createElement('div');
                    imagenBackground.classList.add("imagenBackground");
                    const imagenes = element['fotos'].split(",");
                    imagenBackground.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/publicaciones/?direccion='+imagenes[0]+'")';
                    cardAlquiler.appendChild(imagenBackground);
                    const ciudad = document.createElement('p');
                    ciudad.classList.add("cardTextCiudad");
                    ciudad.textContent = element['ciudad'];
                    cardAlquiler.appendChild(ciudad);
                    const provincia = document.createElement('p');
                    provincia.classList.add("cardTextProvincia");
                    provincia.textContent = element['provincia'];
                    cardAlquiler.appendChild(provincia);
                    const precio = document.createElement('p');
                    precio.classList.add('cardTextPrecio');
                    precio.textContent = "$" + element['costoDia'] + " ars por dia";
                    cardAlquiler.appendChild(precio);
                    cardAlquiler.setAttribute("id", element['idAlq']);
                    if(element['verificado']){
                        const verif = document.createElement("p");
                        verif.classList.add("verif");
                        verif.innerHTML = "<i class='bi bi-patch-check-fill'></i> Verificado";
                        cardAlquiler.appendChild(verif);
                    }
                    cardsAlquileresContainer.appendChild(cardAlquiler);
                });
            }
            resolve();
            }else{
                reject("Error en la respuesta de extraerAlquileresForm");
            }
        }).catch(error => {
            console.error('Error al enviar la solicitud:', error);
            reject("Error en la respuesta de extraerAlquileresForm" + error);
        });
    })
  }


