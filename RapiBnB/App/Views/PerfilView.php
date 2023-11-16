<?php
    include("../App/Views/layouts/navbarUser.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB Perfil</title>
    <link rel="stylesheet" href="./Assets/Css/PerfilView.css">
</head>
<body>

    <section class="perfilSection">
        <div class="perfilContainer">
            <div class="TitleContainer">
                <h2>Datos de perfil</h2>
            </div>
            <div class="datosContainer">
                <div class="izquierda">
                    <article class="DataArticle">
                        <h3>Foto de perfil:</h3>
                        <img id="perfilImagen">
                    </article>
                </div>
                <div class="derecha">
                    <article class="DataArticle">
                        <h3>Nombre:</h3>
                        <p id="pefilNombre"></p>
                    </article>
                    <article class="DataArticle">
                        <h3>Apellido:</h3>
                        <p id="perfilApellido"></p>
                    </article>
                    <article class="DataArticle">
                        <h3>Tipo de documento:</h3>
                        <p id="perfilTipoDoc"></p>
                    </article>
                    <article class="DataArticle">
                        <h3>Número de documento:</h3>
                        <p id="perfilNumDoc"></p>
                    </article>
                    <article class="DataArticle">
                        <h3>Intereses:</h3>
                        <ul id="perfilIntereses">
                            
                        </ul>
                    </article>
                    <article class="DataArticle">
                        <h3>Verificado:</h3>
                        <p id="perfilVerificado"></p>
                    </article>
                </div>
            </div>
            <div id="respuestaSolicitudVerificacion">

            </div>
            <div class="boton">
                    <button class="botonEditarDatos">Editar Perfil</button>
            </div>
            <div class="boton" id="btnVerificar">
                    <button class="botonVerificar">Verificar cuenta</button>
            </div>
        </div> 
    </section>


    <section class="modalEditarContainer" id="modalEditarContainer">
        <div class="modalEditarBody">
            <i class="bi bi-x-square exitModal" id="exitModalEdit"></i>
            <div class="modalEditarCenter">
                <i class="bi bi-exclamation-circle"></i>
                <h4>Importante</h4>
                <p>Al editar algún dato del perfil, tendrás que verificar nuevamente la cuenta</p>
                <div class="boton boton2">
                    <a href="http://localhost/RapiBnB/Public/Perfil/editarPerfil" class="enlaceEditarDatos"><div class="botonEditarDatos">Continuar</div></a>
                </div>
            </div>
        </div>
    </section>

    <section class="modalVerificacion" id="modalVerificacion">
        <div class="modalContainer">
            <i class="bi bi-x-square  exitModal" id="exitModal"></i>
            <h3>Documentación para verificar cuenta:</h3>
            <form action="" enctype="multipart/form-data" class="formDocumentacion" id="modalForm">
                <label for="documentoFrente">Foto del frente del documento:</label>
                <br>
                <input type="file" id="documentoFrente" name="documentoFrente" accept="image/png, image/jpeg, image/jpg">
                <br>
                <label for="documentoDorso">Foto del dorso del documento:</label>
                <br>
                <input type="file" id="documentoDorso" name="documentoDorso" accept="image/png, image/jpeg, image/jpg">
                <br>
                <input type="button" id="btnEnviarDocumentacion" value="enviar">
            </form>
            <div class="modalError" id="modalError">

            </div>
        </div>
        
    </section>



    <script src="./Assets/Js/PerfilView.js"></script>
</body>
</html>

<?php
    include("../App/Views/layouts/footer.php");
?>