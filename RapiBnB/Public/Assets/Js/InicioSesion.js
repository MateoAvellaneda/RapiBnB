const formulario = document.getElementById('formInicioSesion');
const botonEnviar = document.getElementById('btnEnviar');

console.log("chauuuuu");

botonEnviar.addEventListener('click', function(event) {
    event.preventDefault();
    const formData = new FormData(formulario);
    fetch('http://localhost/RapiBnB/Public/InicioSesion/IniciarSesion',{method: 'POST', body: formData}
    ).then(response => response.json()
    ).then(data => {
        if(data.success){
            window.location.replace('http://localhost/RapiBnB/Public');
        }else{
            const containerError = document.getElementById('formError');
            containerError.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
        }
    }).catch(error => {
        console.error('Error al enviar la solicitud:', error);
      });
})