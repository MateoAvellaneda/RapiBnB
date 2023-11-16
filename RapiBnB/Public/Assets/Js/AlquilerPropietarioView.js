var map = L.map('map').setView([-33.331,-66.313], 5);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


const ciudadAlquiler = document.getElementById("ciudadAlquiler");
const provinciaAlquiler = document.getElementById("provinciaAlquiler");
const tituloAlquiler = document.getElementById("tituloAlquiler");
const descripcionAlquiler = document.getElementById("descripcionAlquiler");
const precioAlquiler = document.getElementById("precioAlquiler");
const fotoGrandeContainer = document.getElementById("fotoGrandeContainer");
const fotosPequeñasContainer = document.getElementById("fotosPequeñasContainer");
const provinciaAlquiler2 = document.getElementById("provinciaAlquiler2");
const ciudadAlquiler2 =document.getElementById("ciudadAlquiler2");
const tiempoMinAlquiler = document.getElementById("tiempoMinAlquiler");
const tiempoMaxAlquiler = document.getElementById("tiempoMaxAlquiler");
const fechaIniAlquiler = document.getElementById("fechaIniAlquiler");
const etiquetasAlquilerContainer = document.getElementById("etiquetasAlquilerContainer");
const cupoAlquiler = document.getElementById("cupoAlquiler");
const precioAlquiler2 = document.getElementById("precioAlquiler2");
const fechaFinAlquiler = document.getElementById("fechaFinAlquiler");
const btnOfertarAlquiler = document.querySelector(".btnOfertarAlquiler");
const btnOfertarAlquiler2 = document.querySelector(".btnOfertarAlquiler2");
const formContainer = document.querySelector(".formOfertarContainer");

const modalResponder = document.querySelector(".modalResponderReseniaContainer");
const exitModal = document.getElementById("exitModal");
exitModal.addEventListener("click", function(){
    modalResponder.style.display = "none";
})

const btnEnviarRespuesta = document.getElementById("enviarRespuesta");
    btnEnviarRespuesta.addEventListener("click", function(){
        const formularioResponder = document.getElementById("formResponder");
        const datosFormulario = new FormData(formularioResponder);
        const erroresRespuestaContainer = document.getElementById("erroresRespuestaContainer");
        fetch('http://localhost/RapiBnB/Public/Resenias/PublicarRespuestaResenia',{
            method: 'POST',
            body: datosFormulario
        }
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                location.reload();   
            }else{
                erroresRespuestaContainer.innerHTML = "<i class='bi bi-exclamation-triangle'></i> " + data.message;
            }
        })
})


window.addEventListener("load", function (event) {
    cargaDom().then(function() {
        const reseniasSinRespuesta = document.querySelectorAll(".sinResp");
        console.log(reseniasSinRespuesta);
        if(reseniasSinRespuesta != null){
            reseniasSinRespuesta.forEach((sinResp)=>{
                console.log("holaaaaa");
                sinResp.innerHTML = "";
                sinResp.innerHTML =  `<button class='btnResponder'>Responder</button>`; 
            })
        }
        const btnsResponder = document.querySelectorAll(".btnResponder");
        const idResFormRespuesta = document.getElementById("idResFormRespuesta");
        if(btnsResponder != null){
            console.log("hola22");
            btnsResponder.forEach((btnResponder)=>{
                btnResponder.addEventListener("click", function(){
                    modalResponder.style.display = "block";
                    let idResenia = btnResponder.closest(".divRespuestaResenia").id;
                    idResenia = idResenia.replace('idRes-', ''); 
                    idResFormRespuesta.value = idResenia;
                })
            })
        }
    })
})


function cargaDom(){
    return new Promise((resolve) =>{
        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);
        const idAlq = params.get("idAlq");
        fetch('http://localhost/RapiBnB/Public/Alquiler/getAlquiler/?idAlq='+idAlq
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                ciudadAlquiler.innerHTML = data.alquiler['ciudad'];
                provinciaAlquiler.innerHTML = data.alquiler['provincia'];
                tituloAlquiler.innerHTML = data.alquiler['titulo'];
                descripcionAlquiler.innerHTML = data.alquiler['descripcion'];
                precioAlquiler.innerHTML = "$" + data.alquiler['costoDia'] + " ars";
                const imagenes = data.alquiler['fotos'].split(",");
                fotoGrandeContainer.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/publicaciones/?direccion='+imagenes[0]+'")';
                for(let i=0; i<imagenes.length; i++){
                    console.log("xd");
                    const imagenPequenia = this.document.createElement("div");
                    imagenPequenia.classList.add("fotoPequeña");
                    imagenPequenia.classList.add('fotoPequeña'+(i+1));
                    imagenPequenia.style.backgroundImage = 'url("http://localhost/RapiBnB/Public/Image/publicaciones/?direccion='+imagenes[i]+'")';
                    fotosPequeñasContainer.appendChild(imagenPequenia);
                }
                const imagenesPequenias = document.querySelectorAll(".fotoPequeña");
                imagenesPequenias.forEach((imagen)=>{
                    imagen.addEventListener("click", function(){
                        const background = imagen.style.backgroundImage;
                        fotoGrandeContainer.style.backgroundImage = background;
                    })
                })
                provinciaAlquiler2.innerHTML = data.alquiler['provincia'];
                ciudadAlquiler2.innerHTML = data.alquiler['ciudad'];
                tiempoMinAlquiler.innerHTML = data.alquiler['minTiempo'] + " Dias";
                tiempoMaxAlquiler.innerHTML = data.alquiler["maxTiempo"] + " Dias";
                if(data.alquiler["fechaIni"] == null){
                    fechaIniAlquiler.innerHTML = "No tiene";
                }else{
                    fechaIniAlquiler.innerHTML = data.alquiler['fechaIni'];
                }
    
                if(data.alquiler["fechaFin"] == null){
                    fechaFinAlquiler.innerHTML = "No tiene";
                }else{
                    fechaFinAlquiler.innerHTML = data.alquiler['fechaFin'];
                }
    
                const etiquetas = data.alquiler['etiquetas'].split(",");
                etiquetas.forEach((etiqueta)=>{
                    const pEtiqueta = document.createElement("p");
                    pEtiqueta.classList.add("tableItemContent");
                    pEtiqueta.innerHTML = etiqueta;
                    etiquetasAlquilerContainer.appendChild(pEtiqueta);
                })
    
                cupoAlquiler.innerHTML = data.alquiler['cupo'] + " Personas"; 
                precioAlquiler2.innerHTML = "$" + data.alquiler['costoDia'] + " ars";
    
                const servicios = data.alquiler['servicios'].split(",");
                if(servicios.includes("Gas envasado")){
                    const serviceGasEnv = document.querySelector(".serviceGasEnv");
                    serviceGasEnv.classList.add("active");
                }
                if(servicios.includes("Gas Natural")){
                    const serviceGasNat = document.querySelector(".serviceGasNat");
                    serviceGasNat.classList.add("active");
                }
                if(servicios.includes("Internet")){
                    const serviceInternet = document.querySelector(".serviceInternet");
                    serviceInternet.classList.add("active");
                }
                if(servicios.includes("Agua")){
                    const serviceAgua = document.querySelector(".serviceAgua");
                    serviceAgua.classList.add("active");
                }
                if(servicios.includes("Electricidad")){
                    const serviceElectricidad = document.querySelector(".serviceElectricidad");
                    serviceElectricidad.classList.add("active");
                }
    
                const coordenadas = data.alquiler['coordenadas'].split(",");
                var marker = L.marker(coordenadas).addTo(map);
                map.setView(coordenadas, 14);
                
            }
    
        })
        btnOfertarAlquiler.addEventListener("click", function(){
            let posicionFormulario = formContainer.offsetTop;
            window.scrollTo({
                top: posicionFormulario,
                behavior: 'smooth'
            });
        })
    
        btnOfertarAlquiler2.addEventListener("click", function(){
            let posicionFormulario = formContainer.offsetTop;
            window.scrollTo({
                top: posicionFormulario,
                behavior: 'smooth'
            });
        })
    
        cargarResenias(idAlq).then(function(){resolve()});
    })
    
}



$(function() {
    $("#datepickerFechaIni").datepicker({
            dateFormat: "yy-mm-dd",
            mindate: 0,
            beforeShowDay: function(date) {
                var currentDate = new Date(); // Obtiene la fecha actual
                if (date <= currentDate) {
                  return [false, "dias-anteriores"]; // Devuelve [false] y aplica la clase "dias-anteriores"
                } else {
                  return [true];
                }
            }
    });

    $("#datepickerFechaFin").datepicker({
        dateFormat: "yy-mm-dd",
        mindate: 0,
        beforeShowDay: function(date) {
            var currentDate = new Date(); // Obtiene la fecha actual
            if (date <= currentDate) {
              return [false, "dias-anteriores"]; // Devuelve [false] y aplica la clase "dias-anteriores"
            } else {
              return [true];
            }
        }
    });
});

const btnEnviar = document.getElementById("btnEnviar");
const formOfertar = document.getElementById("formOfertar");
if(btnEnviar != null){
    btnEnviar.addEventListener("click", function(){
        const datosFormulario = new FormData(formOfertar);
        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);
        const idAlq = params.get("idAlq");
        datosFormulario.append('idAlq', idAlq);
        const respuestaFormularioContainer = document.getElementById("respuestaFormularioContainer");
        fetch('http://localhost/RapiBnB/Public/OfertasDeAlquiler/guardarOferta', {
            method: 'POST',
            body: datosFormulario
        }
        ).then(response => response.json()
        ).then(data =>{
            if(data.success){
                respuestaFormularioContainer.innerHTML = "Oferta guardada exitosamente";
            }else{
                respuestaFormularioContainer.innerHTML = data.message;
            }
        }).catch(error => {
            console.error('Error al enviar la solicitud:', error);
          });
    })
}



function cargarResenias(idAlq){
    return new Promise((resolve) =>{
        const reseniasContainer = document.querySelector(".reseniasContainer");
        fetch('http://localhost/RapiBnB/Public/Resenias/estraerReseniasAlquiler/?idAlq='+idAlq
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                const resenias = data.resenias;
                resenias.forEach(resenia=>{
                    const divResenia = document.createElement("div");
                    divResenia.classList.add("divResenia");
                    const nombreUsuResenia = document.createElement("p");
                    nombreUsuResenia.classList.add("nombreUsuResenia");
                    const estrellasReseniaContainer = document.createElement("div");
                    estrellasReseniaContainer.innerHTML =  `<i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>`;
                    const textoResenia = document.createElement("p");
                    textoResenia.classList.add("textoResenia");
                    nombreUsuResenia.innerHTML = resenia['nombre'] +" "+ resenia['apellido'];
                    textoResenia.innerHTML = resenia['texto'];
                    for (let index = 0; index < resenia['puntuacion']; index++) {
                        estrellasReseniaContainer.children[index].style.color = "#ffcc00";
                    }
                    divResenia.appendChild(nombreUsuResenia);
                    divResenia.appendChild(estrellasReseniaContainer);
                    divResenia.appendChild(textoResenia);
                    reseniasContainer.appendChild(divResenia);
                    const divRespuestaResenia = document.createElement("div");
                    divRespuestaResenia.classList.add("divRespuestaResenia");
                    divRespuestaResenia.classList.add("idRes-"+resenia['idReseña']);
                    divRespuestaResenia.setAttribute("id", "idRes-"+resenia['idReseña'])
                    divRespuestaResenia.innerHTML = "<p style='margin:5px 0px' class='sinResp'>Sin respuesta</p>"
                    reseniasContainer.appendChild(divRespuestaResenia);
                    
                })
                const respuestas = data.respuestas;
                respuestas.forEach(respuesta=>{
                    const resContainer = document.querySelector(".idRes-"+respuesta['idResenia']);
                    resContainer.innerHTML = "";
                    const nombreUsuResenia = document.createElement("p");
                    nombreUsuResenia.classList.add("nombreUsuResenia");
                    nombreUsuResenia.innerHTML = "Respuesta del propietario:";
                    const textoResenia = document.createElement("p");
                    textoResenia.classList.add("textoResenia");
                    textoResenia.innerHTML = respuesta['texto'];
                    resContainer.appendChild(nombreUsuResenia);
                    resContainer.appendChild(textoResenia);
                })
                
            }
            resolve();
        })
        
    })
    

}