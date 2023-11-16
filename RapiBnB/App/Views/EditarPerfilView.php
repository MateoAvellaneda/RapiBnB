<?php 
    include("../App/Views/layouts/navbarUser.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>RapiBnB Perfil</title>
    <link rel="stylesheet" href="../Assets/Css/EditarPerfilView.css">
</head>
<body>

    <section class="perfilSection">
        <div class="perfilContainer">
            <div class="TitleContainer">
                <h2>Datos de perfil</h2>
            </div>           
            <form action="" class="datosContainer" enctype="multipart/form-data" id='formulario'>
                <div class="izquierda">
                    <article class="DataArticle">
                        <h3>Foto de perfil: <i class="bi bi-pen-fill iconoEditar" id="editarFoto"></i></h3>
                        <img id="perfilImagen">
                        <input type="file" class="Inputs" id="inputFoto" name="inputFoto" accept="image/png, image/jpeg, image/jpg">
                    </article>
                </div>
                <div class="derecha">
                    <article class="DataArticle">
                        <h3>Nombre: <i class="bi bi-pen-fill iconoEditar" id="editarNombre"></i></h3>
                        <p id="pefilNombre"></p>
                        <input type="text" class="Inputs" id="inputNombre" name="inputNombre">
                    </article>
                    <article class="DataArticle">
                        <h3>Apellido: <i class="bi bi-pen-fill iconoEditar" id="editarApellido"></i></h3>
                        <p id="perfilApellido"></p>
                        <input type="text" class="Inputs" id="inputApellido" name="inputApellido">
                    </article>
                    <article class="DataArticle">
                        <h3>Tipo de documento: <i class="bi bi-pen-fill iconoEditar" id="editarTipoDoc"></i></h3>
                        <p id="perfilTipoDoc"></p>
                        <select name="inputTipoDoc" id="inputTipoDoc" class="Inputs">
                            <option value="">...</option>
                            <option value="DNI">DNI</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </article>
                    <article class="DataArticle">
                        <h3>Número de documento: <i class="bi bi-pen-fill iconoEditar" id="editarNumDoc"></i></h3>
                        <p id="perfilNumDoc"></p>
                        <input type="number" class="Inputs" id="inputNumDoc" name="inputNumDoc">
                    </article>
                    <article class="DataArticle">
                        <h3>Intereses: <i class="bi bi-pen-fill iconoEditar" id="editarIntereses"></i></h3>
                        <ul id="perfilIntereses">     
                        </ul>
                        <input type="checkbox" class="Inputs inputsIntereses" name="inputIntereses[]" value="Cabaña">
                        <label class="Inputs inputsIntereses">Cabañas</label>
                        <input type="checkbox" class="Inputs inputsIntereses" name="inputIntereses[]" value="Playa">
                        <label class="Inputs inputsIntereses">Playas</label>
                        <input type="checkbox" class="Inputs inputsIntereses" name="inputIntereses[]" value="Montañas">
                        <label class="Inputs inputsIntereses">Montañas</label>
                        <input type="checkbox" class="Inputs inputsIntereses" name="inputIntereses[]" value="Hotel">
                        <label class="Inputs inputsIntereses">Hoteles</label>
                    </article>
                </div>
            </form>
            <div id="formError">

            </div>
            <button class="botonEnviar" id="botonEnviar">Guardar cambios</button>
            
        </div> 
    </section>


    <script src="../Assets/Js/EditarPerfilView.js"></script>
</body>
</html>


<?php
    include("../App/Views/layouts/footer.php");
?>