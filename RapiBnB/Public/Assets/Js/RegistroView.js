const formulario = document.getElementById('formRegistro');
const botonRegistrarse = document.getElementById('btnRegistrarse');

console.log("holaaaaaaaaaaaaaaa");


botonRegistrarse.addEventListener('click', function(event){
    event.preventDefault();
    const formData = new FormData(formulario);
    fetch('http://localhost/RapiBnB/Public/Registro/registrar',{method: 'POST', body: formData}
    ).then(response => response.json()
    ).then(data => {
        if(data.success){
            window.location.replace('http://localhost/RapiBnB/Public/Registro/registroExitoso');
        }else{
            const containerError = document.getElementById('formError');
            containerError.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
        }
    }).catch(error => {
        console.error('Error al enviar la solicitud:', error);
      });
})
