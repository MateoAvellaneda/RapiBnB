const tableSolicitudes = document.querySelector(".tableSolicitudes");

window.addEventListener("DOMContentLoaded", function(){
    const exitModal = document.getElementById("exitModal");
    const modalImages = document.querySelector(".modalImages");
    exitModal.addEventListener("click", function(){
        modalImages.style.display = "none";
    })    
 
    cargarSolicitudes()
    .then(function(){
        expandImages();
        buttonsFunction();
    })
})



function cargarSolicitudes(){
    return new Promise((resolve) =>{
        fetch('http://localhost/RapiBnB/Public/Admin/getSolicitudes'
        ).then(response => response.json()
        ).then(data => {
            console.log(data);
            const solicitudes = data.solicitudes;
            solicitudes.forEach(solicitud => {
                const tr = document.createElement("tr");
                tr.setAttribute("id", solicitud['id']);
                const tdNombre = document.createElement("td");
                tdNombre.innerHTML = solicitud['nombre'];
                const tdApellido = document.createElement("td");
                tdApellido.innerHTML = solicitud['apellido'];
                const tdTipoDoc = document.createElement("td");
                tdTipoDoc.innerHTML = solicitud['tipoDoc'];
                const tdNumDoc = document.createElement("td");
                tdNumDoc.innerHTML = solicitud['numDoc'];
                const tdFotoFrente = document.createElement("td");
                const imagenFrenteContainer = document.createElement("div");
                imagenFrenteContainer.classList.add("imagenFrenteContainer");
                imagenFrenteContainer.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/documentacion/?direccion='+solicitud['documentoFrente']+'")';
                tdFotoFrente.appendChild(imagenFrenteContainer);
                const tdFotoDorso = document.createElement("td");
                const imagenDorsoContainer = document.createElement("div");
                imagenDorsoContainer.classList.add("imagenDorsoContainer");
                imagenDorsoContainer.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/documentacion/?direccion='+solicitud['documentoDorso']+'")';
                tdFotoDorso.appendChild(imagenDorsoContainer);
                const tdButtons = document.createElement("td");
                tdButtons.classList.add("btnsTable");
                tdButtons.innerHTML =  `<button class="btnAceptar">Aceptar</button>
                                        <button class="btnRechazar">Rechazar</button>`;
                tr.appendChild(tdNombre);
                tr.appendChild(tdApellido);
                tr.appendChild(tdTipoDoc);
                tr.appendChild(tdNumDoc);
                tr.appendChild(tdFotoFrente);
                tr.appendChild(tdFotoDorso);
                tr.appendChild(tdButtons);
                tableSolicitudes.appendChild(tr);
            });
            resolve();
        })
    })
}

function expandImages(){
    const imagenesFrenteContainer = document.querySelectorAll(".imagenFrenteContainer");
    const imagenesDorsoContainer = document.querySelectorAll(".imagenDorsoContainer");
    const modalImages = document.querySelector(".modalImages");
    const imageContainer = document.querySelector(".imageContainer");
    imagenesFrenteContainer.forEach(imagenFrente => {
        imagenFrente.addEventListener("click", function(){
            imageContainer.style.backgroundImage = imagenFrente.style.backgroundImage;
            modalImages.style.display = "block";
        })
    });

    imagenesDorsoContainer.forEach(imagenDorso => {
        imagenDorso.addEventListener("click", function(){
            imageContainer.style.backgroundImage = imagenDorso.style.backgroundImage;
            modalImages.style.display = "block";
        })
    });
}

function buttonsFunction(){
    const btnsAceptar = document.querySelectorAll(".btnAceptar");
    const btnsRechazar = document.querySelectorAll(".btnRechazar");
    btnsAceptar.forEach(btnAceptar => {
        btnAceptar.addEventListener("click", function(){
            const id = btnAceptar.closest("tr").id;
            fetch('http://localhost/RapiBnB/Public/Admin/aceptarSolicitud',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}`,
            }
            ).then(response => response.json()
            ).then(data => {
                if(data.success){
                    location.reload();
                }
            })
        })
    });

    btnsRechazar.forEach(btnRechazar => {
        btnRechazar.addEventListener("click", function(){
            const id = btnRechazar.closest("tr").id;
            fetch('http://localhost/RapiBnB/Public/Admin/rechazarSolicitud',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}`,
                }
                ).then(response => response.json()
                ).then(data => {
                    if(data.success){
                        location.reload();
                    }
                })
        })
    });
}