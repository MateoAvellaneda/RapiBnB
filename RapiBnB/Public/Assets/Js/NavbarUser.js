const navbarUser = document.getElementById('navBarSpanUser');
window.addEventListener("load", function (event) {
    fetch('http://localhost/RapiBnB/Public/Perfil/getSessionPerfil',{method: 'POST'}
    ).then(response => response.json()
    ).then(data => {
        if(data.success){
            if(data.perfil['nombre'] == null){
                navbarUser.innerHTML = "Usuario";
            }else{
                navbarUser.innerHTML = data.perfil['nombre'];
            }
            
        }else{
            const containerError = document.getElementById('formError');
            containerError.innerHTML = "<p><i class='bi bi-exclamation-triangle'></i>"+data.message+"</p>";
        }
    }).catch(error => {
        console.error('Error al enviar la solicitud:', error);
      });
  });