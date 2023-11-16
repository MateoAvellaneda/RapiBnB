const perfilImagen = document.getElementById('perfilImagen');
const perfilNombre = document.getElementById('pefilNombre');
const perfilApellido = document.getElementById('perfilApellido');
const perfilTipoDoc = document.getElementById('perfilTipoDoc');
const perfilNumDoc = document.getElementById('perfilNumDoc');
const perfilIntereses = document.getElementById('perfilIntereses');


window.addEventListener("load", function (event) {
    fetch('http://localhost/RapiBnB/Public/Perfil/getSessionPerfil',{method: 'POST'}
    ).then(response => response.json()
    ).then(data => {
        if(data.success){
            if(data.perfil['foto'] == null){
                perfilImagen.setAttribute('src','../Assets/Images/blank-profile.jpg');
            }else{
                perfilImagen.setAttribute('src', "../../"+data.perfil['foto']);
            }

            if(data.perfil['nombre'] == null){
                perfilNombre.innerHTML = "Sin asignar";
            }else{
                perfilNombre.innerHTML = data.perfil['nombre'];
            }

            if(data.perfil['apellido'] == null){
                perfilApellido.innerHTML = "Sin asignar";
            }else{
                perfilApellido.innerHTML = data.perfil['apellido'];
            }

            if(data.perfil['tipoDoc'] == null){
                perfilTipoDoc.innerHTML = "Sin asignar";
            }else{
                perfilTipoDoc.innerHTML = data.perfil['tipoDoc'];
            }

            if(data.perfil['numDoc'] == null){
                perfilNumDoc.innerHTML = "Sin asignar";
            }else{
                perfilNumDoc.innerHTML = data.perfil['numDoc'];
            }

            if(data.perfil['intereses'] == null){
                perfilIntereses.innerHTML = "Sin asignar";
            }else{
                let arrayIntereses =  data.perfil['intereses'].split(",");
                for(var i=0; i<arrayIntereses.length; i++){
                    let listItem = document.createElement("li");
                    listItem.innerHTML = arrayIntereses[i];
                    perfilIntereses.appendChild(listItem);
                }
            }

            
        }else{
            const containerError = document.getElementById('formError');
            containerError.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
        }
    }).catch(error => {
        console.error('Error al enviar la solicitud:', error);
      });
  });

const editarFoto = document.getElementById('editarFoto');
const editarNombre = document.getElementById('editarNombre');
const editarApellido = document.getElementById('editarApellido');
const editarTipoDoc = document.getElementById('editarTipoDoc');
const editarNumDoc = document.getElementById('editarNumDoc');
const editarIntereses = document.getElementById('editarIntereses');

const inputFoto = document.getElementById('inputFoto');
editarFoto.addEventListener("click", function(event){
    inputFoto.click();
})

inputFoto.addEventListener("change", function() {
    const selectedFile = inputFoto.files[0];
    if (selectedFile) {
        const perfilImagen = document.getElementById('perfilImagen');
        perfilImagen.setAttribute('src', URL.createObjectURL(selectedFile));
    }
  });
  

editarNombre.addEventListener("click", function(event){
    const inputNombre = document.getElementById('inputNombre');
    inputNombre.style.display = "inline-block";
})


editarApellido.addEventListener("click", function(event){
    const inputApellido = document.getElementById('inputApellido');
    inputApellido.style.display = "inline-block";
})

editarTipoDoc.addEventListener("click", function(event){
    const inputTipoDoc = document.getElementById('inputTipoDoc');
    inputTipoDoc.style.display = "inline-block";
})

editarNumDoc.addEventListener("click", function(event){
    const inputNumDoc = document.getElementById('inputNumDoc');
    inputNumDoc.style.display = "inline-block";
})

editarIntereses.addEventListener("click", function(event){
    let inputsIntereses = document.getElementsByClassName("inputsIntereses");
    for (let i = 0; i < inputsIntereses.length; i++) {
        inputsIntereses[i].style.display = "inline-block";
      }
})

const formulario = document.getElementById('formulario');
const botonEnviar = document.getElementById('botonEnviar');
botonEnviar.addEventListener("click", function(event){
    const formData = new FormData(formulario);
    fetch('http://localhost/RapiBnB/Public/Perfil/actualizarPerfil',{method: 'POST', body: formData}
    ).then(response => response.json()
    ).then(data => {
        if(data.success){
            window.location.replace('http://localhost/RapiBnB/Public/Perfil');
        }else{
            const containerError = document.getElementById('formError');
            containerError.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
        }
    }).catch(error => {
        console.error('Error al enviar la solicitud:', error);
      });
})