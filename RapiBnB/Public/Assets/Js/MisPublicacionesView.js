window.addEventListener("DOMContentLoaded", function () {
    const modalError = document.getElementById("modalError");
    const exitModal = document.getElementById("exitModal");
    exitModal.addEventListener("click", function(){
        modalError.style.display = "none";
    })
    const errorModalContainer = document.getElementById("errorModalContainer");
    CargarPublicacionesActivas()
    .then(()=>{
        const botonesVer = document.querySelectorAll(".btnVer");
        botonesVer.forEach(botonVer => {
            botonVer.addEventListener("click",function(){
                const idPublicacion = botonVer.closest(".publicacionActiva").id;
                window.location.replace('http://localhost/RapiBnB/Public/Alquiler/index/?idAlq='+idPublicacion);
            })
        });
        const botonesOfertas = document.querySelectorAll(".btnOfertas");
        botonesOfertas.forEach(botonOferta => {
            botonOferta.addEventListener("click", function(){
                const idPublicacion = botonOferta.closest(".publicacionActiva").id;
                window.location.replace('http://localhost/RapiBnB/Public/OfertasDeAlquiler/verOfertasPorAlquiler/?idAlq='+idPublicacion);
            })
        });

        const botonesDesactivar = document.querySelectorAll(".btnDesactivar");
        botonesDesactivar.forEach(botonDesactivar =>{
            botonDesactivar.addEventListener("click", function(){
                const idPublicacion = botonDesactivar.closest(".publicacionActiva").id;
                fetch('http://localhost/RapiBnB/Public/MisPublicaciones/desactivarAlquiler/?idAlq='+idPublicacion
                ).then(response => response.json()
                ).then(data => {
                    if(data.success){
                        window.location.href = "http://localhost/RapiBnB/Public/MisPublicaciones";
                    }else{
                        errorModalContainer.innerHTML = data.message;
                        modalError.style.display = "block";
                    }
                })
            })
        })
        
    })
    CargarPublicacionesDesactivadas()
    .then(()=>{
        const botonesVer = document.querySelectorAll(".btnVer");
        botonesVer.forEach(botonVer => {
            botonVer.addEventListener("click",function(){
                const idPublicacion = botonVer.closest(".publicacionPausada").id;
                window.location.replace('http://localhost/RapiBnB/Public/Alquiler/index/?idAlq='+idPublicacion);
            })
        });
        const botonesOfertas = document.querySelectorAll(".btnOfertas");
        botonesOfertas.forEach(botonOferta => {
            botonOferta.addEventListener("click", function(){
                const idPublicacion = botonOferta.closest(".publicacionPausada").id;
                window.location.replace('http://localhost/RapiBnB/Public/OfertasDeAlquiler/verOfertasPorAlquiler/?idAlq='+idPublicacion);
            })
        });
        const botonesActivar = document.querySelectorAll(".btnActivar");
        botonesActivar.forEach(botonActivar => {
            botonActivar.addEventListener("click", function(){
                const idPublicacion = botonActivar.closest(".publicacionPausada").id;
                fetch('http://localhost/RapiBnB/Public/MisPublicaciones/activarAlquiler/?idAlq='+idPublicacion
                    ).then(response => response.json()
                    ).then(data => {
                        if(data.success){
                            window.location.href = "http://localhost/RapiBnB/Public/MisPublicaciones";
                        }else{
                            errorModalContainer.innerHTML = data.message;
                            modalError.style.display = "block";
                        }
                    })
            })
            
        })
    })
})



function CargarPublicacionesActivas(){
    return new Promise((resolve, reject) =>{
        const publicacionesActivasContainer = document.querySelector(".publicacionesActivasContainer");
        fetch('http://localhost/RapiBnB/Public/MisPublicaciones/getPublicacionesActivas'
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                if(data.publicaciones != null){
                    const alquileres = data.publicaciones;
                    alquileres.forEach(alquiler => {
                        const publicacionActiva = document.createElement("div");
                        publicacionActiva.classList.add("publicacionActiva");
                        const publicacionImagenContainer = document.createElement("div");
                        publicacionImagenContainer.classList.add("publicacionImagenContainer");
                        const publicacionImagen = document.createElement("div");
                        publicacionImagen.classList.add("publicacionImagen");
                        const imagenesPublicacion = alquiler['fotos'].split(",");
                        publicacionImagen.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/publicaciones/?direccion='+imagenesPublicacion[0]+'")';
                        publicacionImagenContainer.appendChild(publicacionImagen);
                        publicacionActiva.appendChild(publicacionImagenContainer);
                        const publicacionTitleContainer = document.createElement("div");
                        publicacionTitleContainer.classList.add("publicacionTitleContainer");
                        const tituloPublicacion = document.createElement("p");
                        tituloPublicacion.innerHTML = alquiler['titulo'];
                        publicacionTitleContainer.appendChild(tituloPublicacion);
                        publicacionActiva.appendChild(publicacionTitleContainer);
                        const publicacionBotonesContainer = document.createElement("div");
                        publicacionBotonesContainer.classList.add("publicacionBotonesContainer");
                        const btnVer = document.createElement("button");
                        const btnOfertas = document.createElement("button");
                        const btnDesactivar = document.createElement("button");
                        const btnEliminar = document.createElement("button");
                        btnVer.classList.add("btnVer");
                        btnOfertas.classList.add("btnOfertas");
                        btnDesactivar.classList.add("btnDesactivar");
                        btnEliminar.classList.add("btnEliminar");
                        btnVer.innerHTML = "Ver";
                        btnOfertas.innerHTML = "Ofertas";
                        btnDesactivar.innerHTML = "Desactivar";
                        btnEliminar.innerHTML = "Eliminar";
                        publicacionBotonesContainer.appendChild(btnVer);
                        publicacionBotonesContainer.appendChild(btnOfertas);
                        publicacionBotonesContainer.appendChild(btnDesactivar);
                        // publicacionBotonesContainer.appendChild(btnEliminar);
                        publicacionActiva.appendChild(publicacionBotonesContainer);
                        publicacionActiva.setAttribute("id", alquiler['idAlq']);
                        publicacionesActivasContainer.appendChild(publicacionActiva);
                    });
                }
                resolve();
            }else{
                reject("Error en la respuesta de getPublicacionesActivas");
            }
        }).catch(error => {
            console.error('Error al enviar la solicitud:', error);
            reject("Error en la respuesta de getPublicacionesActivas:" + error);
        });

    })
    


}

function CargarPublicacionesDesactivadas(){
    return new Promise((resolve, reject) =>{
        const publicacionesDesactivadasContainer = document.querySelector(".publicacionesDesactivadasContainer");
        fetch('http://localhost/RapiBnB/Public/MisPublicaciones/getPublicacionesDesactivadas'
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                if(data.publicaciones != null){
                    const alquileres = data.publicaciones;
                    alquileres.forEach(alquiler => {
                        const publicacionPausada = document.createElement("div");
                        publicacionPausada.classList.add("publicacionPausada");
                        const publicacionImagenContainer = document.createElement("div");
                        publicacionImagenContainer.classList.add("publicacionImagenContainer");
                        const publicacionImagen = document.createElement("div");
                        publicacionImagen.classList.add("publicacionImagen");
                        const imagenesPublicacion = alquiler['fotos'].split(",");
                        publicacionImagen.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/publicaciones/?direccion='+imagenesPublicacion[0]+'")';
                        publicacionImagenContainer.appendChild(publicacionImagen);
                        publicacionPausada.appendChild(publicacionImagenContainer);
                        const publicacionTitleContainer = document.createElement("div");
                        publicacionTitleContainer.classList.add("publicacionTitleContainer");
                        const tituloPublicacion = document.createElement("p");
                        tituloPublicacion.innerHTML = alquiler['titulo'];
                        publicacionTitleContainer.appendChild(tituloPublicacion);
                        publicacionPausada.appendChild(publicacionTitleContainer);
                        const publicacionBotonesContainer = document.createElement("div");
                        publicacionBotonesContainer.classList.add("publicacionBotonesContainer");
                        const btnVer = document.createElement("button");
                        const btnOfertas = document.createElement("button");
                        const btnActivar = document.createElement("button");
                        const btnEliminar = document.createElement("button");
                        btnVer.classList.add("btnVer");
                        btnOfertas.classList.add("btnOfertas");
                        btnActivar.classList.add("btnActivar");
                        btnEliminar.classList.add("btnEliminar");
                        btnVer.innerHTML = "Ver";
                        btnOfertas.innerHTML = "Ofertas";
                        btnActivar.innerHTML = "Activar";
                        btnEliminar.innerHTML = "Eliminar";
                        publicacionBotonesContainer.appendChild(btnVer);
                        publicacionBotonesContainer.appendChild(btnOfertas);
                        publicacionBotonesContainer.appendChild(btnActivar);
                        // publicacionBotonesContainer.appendChild(btnEliminar);
                        publicacionPausada.appendChild(publicacionBotonesContainer);
                        publicacionPausada.setAttribute("id", alquiler['idAlq']);
                        publicacionesDesactivadasContainer.appendChild(publicacionPausada);
                    });
                }
                resolve();
            }else{
                reject("Error en la respuesta de getPublicacionesDesactivadas");
            }
        }).catch(error => {
            console.error('Error al enviar la solicitud:', error);
            reject("Error en la respuesta de getPublicacionesDesactivadas:" + error);
        });
    })
    

}