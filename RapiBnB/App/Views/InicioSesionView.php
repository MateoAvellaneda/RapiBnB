<?php
    include("../App/Views/layouts/navbarAnonymous.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB Sesion</title>
    <link rel="stylesheet" href="./Assets/Css/InicioSesionView.css">
</head>
<body>

    
        <section class="sectionFormulario">
            <div class="containerForm">
                <div class="containerTitleForm">
                    <h2>Iniciar Sesión</h2>
                </div>
                <div class="containerInputsForm">
                    <form action="" method="POST" id="formInicioSesion">
                        <label for="username">
                            <p>Nombre de usuario:</p>
                            <input type="text" name="username" id="username" required>
                        </label>
                        <br>
                        <label for="password">
                            <p>Contraseña:</p>
                            <input type="password" name="password" id="password" required>
                        </label>
                        <br>
                        <input type="submit" name="submit" id="btnEnviar" value="Iniciar sesion">
                    </form>
                </div>
                <div class="error" id="formError">
                    
                </div>
                <p class="textoRegistrarse">¿No tienes cuenta de usuario? <a href="http://localhost/RapiBnB/Public/Registro">Registrarse</a></p>
            </div>
        </section>

        <script src="./Assets/Js/InicioSesion.js"></script>
</body>
</html>


<?php
    include("../App/Views/layouts/footer.php");
?>