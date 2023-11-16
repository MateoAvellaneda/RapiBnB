var map = L.map('map').setView([-33.331,-66.313], 5);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

window.addEventListener("load",function(){
    const exitModal = document.getElementById("exitModal");
    exitModal.addEventListener("click", function(){
        ModalInfoFechas.style.display = "none";
    })
    const ModalInfoFechas = document.querySelector(".ModalInfoFechas");
    const infoFechaIni = document.getElementById("infoFechaIni");
    infoFechaIni.addEventListener("click", function(){
        ModalInfoFechas.style.display = "block";
    })
    const infoFechaFin = document.getElementById("infoFechaFin");
    infoFechaFin.addEventListener("click", function(){
        ModalInfoFechas.style.display = "block";
    })
})

var marker = null;
const Inputcoordenadas = document.getElementById('coordenadas');
function onMapClick(e) {
    
    if (marker) {
        map.removeLayer(marker);
    }
    marker = new L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
    coordenadas = marker.getLatLng();
    Inputcoordenadas.setAttribute('value',coordenadas.lat + "," + coordenadas.lng);
}

map.on('click', onMapClick);

var Inputfotos = document.getElementById("fotos");
Inputfotos.addEventListener("change", function() {
    var fotosSeleccionadas = Inputfotos.files;
    var maxFotos = 5; // Establece el número máximo de archivos permitidos

    if (fotosSeleccionadas.length > maxFotos) {
        alert("Máximo " + maxFotos + " archivos permitidos. Por favor, seleccione un máximo de " + maxFotos + " archivos.");
        Inputfotos.value = ""; // Limpia la selección
    }
});


const formulario = document.getElementById('formulario');
const botonPublicar = document.getElementById('btnPublicar');
botonPublicar.addEventListener("click", function(event){
    const formData = new FormData(formulario);
    fetch('http://localhost/RapiBnB/Public/PublicarAlquiler/publicarAlquiler',{method: 'POST', body: formData}
    ).then(response => response.json()
    ).then(data => {
        if(data.success){
            window.location.replace('http://localhost/RapiBnB/Public/PublicarAlquiler/publicacionExitosa');
        }else{
            const containerError = document.getElementById('formError');
            containerError.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
        }
    }).catch(error => {
        console.error('Error al enviar la solicitud:', error);
      });
    
    
})