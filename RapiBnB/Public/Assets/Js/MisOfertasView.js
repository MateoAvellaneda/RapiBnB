window.addEventListener("DOMContentLoaded", function (){
    cargarOfertas()
    .then(()=>{
        const modalResenia = document.querySelector(".modalResenia");
        const exitModal = document.getElementById("exitModal");
        const inputReseniaIdOferta = document.getElementById("reseniaIdOferta");
        const formResenia = document.getElementById("formResenia");
        const pErrorModal = document.getElementById("pErrorModal");
        exitModal.addEventListener("click", function(){
            inputReseniaIdOferta.value = "";
            modalResenia.style.display = "none";
        })
        const btnsReseñar = document.querySelectorAll(".btnReseñar");
        if(btnsReseñar){
            btnsReseñar.forEach(btnReseñar => {
                btnReseñar.addEventListener("click", function(){
                    inputReseniaIdOferta.value = btnReseñar.closest(".ofertaAlquiler").id;
                    modalResenia.style.display = "block";
                })
            })   
        }
        const btnEnviarResenia = document.getElementById("btnEnviarResenia");
        btnEnviarResenia.addEventListener("click", function(){
            const formData = new FormData(formResenia);
            fetch('http://localhost/RapiBnB/Public/Resenias/publicarResenia',{method: 'POST', body: formData}
            ).then(response => response.json()
            ).then(data => {
                if(data.success){
                    window.location.href = "http://localhost/RapiBnB/Public/OfertasDeAlquiler/misOfertas";
                }else{
                    pErrorModal.innerHTML = "<i class='bi bi-exclamation-triangle'></i> " + data.message;
                }
            }).catch(error => {
                console.error('Error al enviar la solicitud:', error);
      });
        })

    })
})


function cargarOfertas(){
    return new Promise((resolve, reject) =>{ 
        const containerPendientes = document.getElementById("ContainerPendientes");
        const containerEnProceso = document.getElementById("ContainerEnProceso");
        const containerFinalizadas = document.getElementById("ContainerFinalizadas");
        fetch('http://localhost/RapiBnB/Public/OfertasDeAlquiler/getMisOfertas'
        ).then(response => response.json()
        ).then(data => {
            if(data.success){ 
                const tituloContainer = document.createElement("div");
                tituloContainer.classList.add("tituloContainer");
                const tableBorder = document.createElement("div");
                tableBorder.classList.add("bordeTabla");
                const ciudadContainer = document.createElement("div");
                ciudadContainer.classList.add("ciudadContainer");
                const fechaIniContainer = document.createElement("div");
                fechaIniContainer.classList.add("fechaIniContainer");
                const fechaFinContainer = document.createElement("div");
                fechaFinContainer.classList.add("fechaFinContainer");
                const estadoContainer = document.createElement("div");
                estadoContainer.classList.add("estadoContainer");
                const btnContainer = document.createElement("div");
                btnContainer.classList.add("btnContainer");
                const ofertasPendientes = data.ofertasPendientes;
                if(ofertasPendientes != false){
                    ofertasPendientes.forEach(ofertaPendiente => {
                        const ofertaAlquiler = document.createElement("div");
                        ofertaAlquiler.classList.add("ofertaAlquiler");
                        tituloContainer.innerHTML = ofertaPendiente['titulo'];
                        ofertaAlquiler.appendChild(tituloContainer.cloneNode(true));                 
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        ciudadContainer.innerHTML = ofertaPendiente['ciudad'];
                        ofertaAlquiler.appendChild(ciudadContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        fechaIniContainer.innerHTML = ofertaPendiente['fechaIni'];
                        ofertaAlquiler.appendChild(fechaIniContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        fechaFinContainer.innerHTML = ofertaPendiente['fechaFin'];
                        ofertaAlquiler.appendChild(fechaFinContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        estadoContainer.innerHTML = ofertaPendiente['estado'];
                        ofertaAlquiler.appendChild(estadoContainer.cloneNode(true));                      
                        ofertaAlquiler.setAttribute("id", ofertaPendiente['idOferta']);
                        containerPendientes.appendChild(ofertaAlquiler);
                    });
                }
                // SEGUI ACAAAAAAAAAAAAAAAAAAA!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                //AGUANTE CHARLY LOCOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
                const ofertasAceptadas = data.ofertasAceptadas;
                if(ofertasAceptadas!=false){
                    ofertasAceptadas.forEach(oferta =>{
                        if(oferta['estado'] == 'finalizado'){
                            const ofertaAlquiler = document.createElement("div");
                            ofertaAlquiler.classList.add("ofertaAlquiler");
                            tituloContainer.innerHTML = oferta['titulo'];
                            ofertaAlquiler.appendChild(tituloContainer.cloneNode(true));                 
                            ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                            ciudadContainer.innerHTML = oferta['ciudad'];
                            ofertaAlquiler.appendChild(ciudadContainer.cloneNode(true));
                            ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                            fechaIniContainer.innerHTML = oferta['fechaIni'];
                            ofertaAlquiler.appendChild(fechaIniContainer.cloneNode(true));
                            ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                            fechaFinContainer.innerHTML = oferta['fechaFin'];
                            ofertaAlquiler.appendChild(fechaFinContainer.cloneNode(true));
                            ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                            btnContainer.innerHTML = '';
                            if(data.ofertasSinReseña.includes(oferta['id'])){
                                btnContainer.innerHTML = `<button class="btnReseñar">Reseñar</button>`;
                            }
                            ofertaAlquiler.appendChild(btnContainer.cloneNode(true));
                            ofertaAlquiler.setAttribute("id", oferta['id']);
                            containerFinalizadas.appendChild(ofertaAlquiler);
                        }else{
                            const ofertaAlquiler = document.createElement("div");
                            ofertaAlquiler.classList.add("ofertaAlquiler");
                            tituloContainer.innerHTML = oferta['titulo'];
                            ofertaAlquiler.appendChild(tituloContainer.cloneNode(true));                 
                            ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                            ciudadContainer.innerHTML = oferta['ciudad'];
                            ofertaAlquiler.appendChild(ciudadContainer.cloneNode(true));
                            ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                            fechaIniContainer.innerHTML = oferta['fechaIni'];
                            ofertaAlquiler.appendChild(fechaIniContainer.cloneNode(true));
                            ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                            fechaFinContainer.innerHTML = oferta['fechaFin'];
                            ofertaAlquiler.appendChild(fechaFinContainer.cloneNode(true));
                            ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                            estadoContainer.innerHTML = oferta['estado'];
                            ofertaAlquiler.appendChild(estadoContainer.cloneNode(true));                      
                            ofertaAlquiler.setAttribute("id", oferta['id']);
                            containerEnProceso.appendChild(ofertaAlquiler);
                        }
                       
                    })
                }
                resolve();
            }else{
                reject("Error en la respuesta de getMisOfertas");
            }
        }).catch(error => {
            console.error('Error al enviar la solicitud:', error);
            reject("Error en la respuesta de getMisOfertas:" + error);
        });
    })
}