window.addEventListener("DOMContentLoaded", function (){
    cargarOfertas()
    .then(()=>{ 
        const btnsAceptar = document.querySelectorAll(".btnAceptar");
        if(btnsAceptar){
            btnsAceptar.forEach(btnAceptar=>{
                btnAceptar.addEventListener("click", function(){
                    const idOferta = btnAceptar.closest(".ofertaAlquiler").id;
                    fetch('http://localhost/RapiBnB/Public/OfertasDeAlquiler/aceptarOferta/?idOferta='+idOferta
                    ).then(response => response.json()
                    ).then(data => { 
                        if(data.success){
                            window.location.reload();
                        }else{

                        }
                    })
                })
            })
        }

        const btnsRechazar = document.querySelectorAll(".btnRechazar");
        if(btnsRechazar){
            btnsRechazar.forEach(btnRechazar=>{
                btnRechazar.addEventListener("click", function(){
                    const idOferta = btnRechazar.closest(".ofertaAlquiler").id;
                    fetch('http://localhost/RapiBnB/Public/OfertasDeAlquiler/rechazarOferta/?idOferta='+idOferta
                    ).then(response => response.json()
                    ).then(data => { 
                        if(data.success){
                            window.location.reload();
                        }else{

                        }
                    })
                })
            })
        }
    })
})


function cargarOfertas(){
    return new Promise((resolve, reject) =>{ 
        const containerPendientes = document.getElementById("ContainerPendientes");
        const containerEnProceso = document.getElementById("ContainerEnProceso");
        const containerFinalizadas = document.getElementById("ContainerFinalizadas");
        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);
        const idAlq = params.get("idAlq");
        fetch('http://localhost/RapiBnB/Public/OfertasDeAlquiler/getOfertasPorAlquiler/?idAlq='+idAlq
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                const tituloAlq = document.getElementById("tituloAlq");
                tituloAlq.innerHTML = data['nombreAlquiler'];
                const nombreContainer = document.createElement("div");
                nombreContainer.classList.add("nombreContainer");
                const tableBorder = document.createElement("div");
                tableBorder.classList.add("bordeTabla");
                const telefonoContainer = document.createElement("div");
                telefonoContainer.classList.add("telefonoContainer");
                const emailContainer = document.createElement("div");
                emailContainer.classList.add("emailContainer");
                const cantPersonasContainer = document.createElement("div");
                cantPersonasContainer.classList.add("cantPersonasContainer");
                const fechaIniContainer = document.createElement("div");
                fechaIniContainer.classList.add("fechaIniContainer");
                const fechaFinContainer = document.createElement("div");
                fechaFinContainer.classList.add("fechaFinContainer");
                const btnContainer = document.createElement("div");
                btnContainer.classList.add("btnContainer");
                const ofertasPendientes = data.ofertasPendientes;
                if(ofertasPendientes != false){
                    ofertasPendientes.forEach(ofertaPendiente => {
                        const ofertaAlquiler = document.createElement("div");
                        ofertaAlquiler.classList.add("ofertaAlquiler");
                        ofertaAlquiler.classList.add("ofertasPendientes");
                        nombreContainer.innerHTML = ofertaPendiente['nombre'];
                        ofertaAlquiler.appendChild(nombreContainer.cloneNode(true));                 
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        telefonoContainer.innerHTML = ofertaPendiente['telefono'];
                        ofertaAlquiler.appendChild(telefonoContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        emailContainer.innerHTML = ofertaPendiente['email'];
                        ofertaAlquiler.appendChild(emailContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        cantPersonasContainer.innerHTML = ofertaPendiente['cantPersonas'];
                        ofertaAlquiler.appendChild(cantPersonasContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        fechaIniContainer.innerHTML = ofertaPendiente['fechaIni'];
                        ofertaAlquiler.appendChild(fechaIniContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        fechaFinContainer.innerHTML = ofertaPendiente['fechaFin'];
                        ofertaAlquiler.appendChild(fechaFinContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        btnContainer.innerHTML = `<button class="btnAceptar">Aceptar</button>
                        <button class="btnRechazar">Rechazar</button>`;
                        ofertaAlquiler.appendChild(btnContainer.cloneNode(true));
                        ofertaAlquiler.setAttribute("id", ofertaPendiente['idOferta']);
                        containerPendientes.appendChild(ofertaAlquiler);
                    });
                }
                
                const ofertasEnProceso = data.ofertasEnProceso;
                if(ofertasEnProceso!=false){
                    ofertasEnProceso.forEach(ofertaEnProceso =>{
                        const ofertaAlquiler = document.createElement("div");
                        ofertaAlquiler.classList.add("ofertaAlquiler");
                        nombreContainer.innerHTML = ofertaEnProceso['nombre'];
                        ofertaAlquiler.appendChild(nombreContainer.cloneNode(true));                 
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        telefonoContainer.innerHTML = ofertaEnProceso['telefono'];
                        ofertaAlquiler.appendChild(telefonoContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        emailContainer.innerHTML = ofertaEnProceso['email'];
                        ofertaAlquiler.appendChild(emailContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        cantPersonasContainer.innerHTML = ofertaEnProceso['cantPersonas'];
                        ofertaAlquiler.appendChild(cantPersonasContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        fechaIniContainer.innerHTML = ofertaEnProceso['fechaIni'];
                        ofertaAlquiler.appendChild(fechaIniContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        fechaFinContainer.innerHTML = ofertaEnProceso['fechaFin'];
                        ofertaAlquiler.appendChild(fechaFinContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        btnContainer.innerHTML = '';
                        ofertaAlquiler.appendChild(btnContainer.cloneNode(true));
                        ofertaAlquiler.setAttribute("id", ofertaEnProceso['id']);
                        containerEnProceso.appendChild(ofertaAlquiler);
                    })
                }
               
                const ofertasFinalizadas = data.ofertasFinalizadas;
                if(ofertasFinalizadas != false){
                    ofertasFinalizadas.forEach(ofertaFinalizada=>{
                        const ofertaAlquiler = document.createElement("div");
                        ofertaAlquiler.classList.add("ofertaAlquiler");
                        nombreContainer.innerHTML = ofertaFinalizada['nombre'];
                        ofertaAlquiler.appendChild(nombreContainer.cloneNode(true));                 
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        telefonoContainer.innerHTML = ofertaFinalizada['telefono'];
                        ofertaAlquiler.appendChild(telefonoContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        emailContainer.innerHTML = ofertaFinalizada['email'];
                        ofertaAlquiler.appendChild(emailContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        cantPersonasContainer.innerHTML = ofertaFinalizada['cantPersonas'];
                        ofertaAlquiler.appendChild(cantPersonasContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        fechaIniContainer.innerHTML = ofertaFinalizada['fechaIni'];
                        ofertaAlquiler.appendChild(fechaIniContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        fechaFinContainer.innerHTML = ofertaFinalizada['fechaFin'];
                        ofertaAlquiler.appendChild(fechaFinContainer.cloneNode(true));
                        ofertaAlquiler.appendChild(tableBorder.cloneNode(true));
                        btnContainer.innerHTML = '';
                        ofertaAlquiler.appendChild(btnContainer.cloneNode(true));
                        ofertaAlquiler.setAttribute("id", ofertaFinalizada['id']);
                        containerFinalizadas.appendChild(ofertaAlquiler);
                    })
                }
                
                resolve();
            }else{
                reject("Error en la respuesta de getOfertasPorAlquiler");
            }
        }).catch(error => {
            console.error('Error al enviar la solicitud:', error);
            reject("Error en la respuesta de getOfertasPorAlquiler:" + error);
        });
    })
}