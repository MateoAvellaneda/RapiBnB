const perfilImagen = document.getElementById('perfilImagen');
const perfilNombre = document.getElementById('pefilNombre');
const perfilApellido = document.getElementById('perfilApellido');
const perfilTipoDoc = document.getElementById('perfilTipoDoc');
const perfilNumDoc = document.getElementById('perfilNumDoc');
const perfilIntereses = document.getElementById('perfilIntereses');
const perfilVerificado = document.getElementById('perfilVerificado');
const btnVerificar = document.getElementById('btnVerificar');
window.addEventListener("load", function (event) {
    fetch('http://localhost/RapiBnB/Public/Perfil/getSessionPerfil'
    ).then(response => response.json()
    ).then(data => {
        if(data.success){
            if(data.perfil['foto'] == null){
                perfilImagen.setAttribute('src','./Assets/Images/blank-profile.jpg');
            }else{
                perfilImagen.setAttribute('src', ".."+data.perfil['foto']);
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

            if(data.perfil['verificado'] == 0){
                let iconoCruz = document.createElement("i");
                iconoCruz.setAttribute('class','bi bi-x-circle-fill');
                iconoCruz.innerHTML = "Sin verificar";
                perfilVerificado.appendChild(iconoCruz);
                btnVerificar.style.visibility = "visible";
            }else{
                let iconoCheck = document.createElement("i");
                iconoCheck.setAttribute('class','bi bi-check-circle-fill');
                iconoCheck.innerHTML = "Verificado";
                perfilVerificado.appendChild(iconoCheck);
            }
            
        }else{
            const containerError = document.getElementById('formError');
            containerError.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
        }
    }).catch(error => {
        console.error('Error al enviar la solicitud:', error);
      });
      const modalEditarContainer = document.getElementById("modalEditarContainer");
      const botonEditarDatos = document.querySelector(".botonEditarDatos");
      botonEditarDatos.addEventListener("click", function(){
        modalEditarContainer.style.display = "block";
      })

        const modalVerificacion = document.getElementById("modalVerificacion");
        const exitModal = document.getElementById("exitModal");
         exitModal.addEventListener("click", function(){
            modalVerificacion.style.display = "none";
         })    

         
         const exitModalEdit = document.getElementById("exitModalEdit");
         exitModalEdit.addEventListener("click", function(){
            console.log("hola");
             modalEditarContainer.style.display = "none";
         })

  });


  const containerRespuesta = document.getElementById('respuestaSolicitudVerificacion');
  

  const btnEnviarDocumentacion = document.getElementById("btnEnviarDocumentacion");
  const modalError = document.getElementById("modalError");
  const formulario = document.getElementById("modalForm");
  btnVerificar.addEventListener("click", function(event){
    fetch('http://localhost/RapiBnB/Public/Perfil/checkSolicitudVerificacion',{method: 'POST'}
    ).then(response => response.json()
    ).then(data => {
        if(data.success){
            modalVerificacion.style.display="block";
        }else{
            containerRespuesta.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
        }
    }).catch(error =>{
        console.error('Error al enviar la solicitud', error);
    });

    document.addEventListener('DOMContentLoaded',function(){
        
        

    })




    btnEnviarDocumentacion.addEventListener("click", function(){
        const formData = new FormData(formulario);
        fetch('http://localhost/RapiBnB/Public/Perfil/enviarSolicitudVerificacion',{method: 'POST', body: formData}
        ).then(response => response.json()
        ).then(data => {
            if(data.success){
                modalVerificacion.style.display = "none";
                containerRespuesta.innerHTML = "<p><i class='bi bi-check-circle'></i>"+data.message+"</p>"
            }else{
                modalError.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
            }
        }).catch(error =>{
            console.error('Error al enviar la solicitud', error);
        });
    })
  })