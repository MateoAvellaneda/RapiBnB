<?php
    include("../App/Views/layouts/navbarAnonymous.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB Registro</title>
    <link rel="stylesheet" href="./Assets/Css/RegistroView.css">
</head>
<body>

        <section class="sectionForm">
            <div class="containerForm">
                <div class="containerTitleForm">
                    <h2>Formulario de registro</h2>
                </div>
                <div class="containerInputsForm">
                    <form action="" method="POST"id="formRegistro">
                        <label for="username">
                            <p>Nombre de usuario:</p>
                            <input type="text" name="username" id="username" required>
                        </label>
                        <br>
                        <label for="email">
                            <p>Correo electrónico:</p>
                            <input type="email" name="email" id="email" required>
                        </label>
                        <br>
                        <label for="password">
                            <p>Contraseña:</p>
                            <input type="password" name="password" id="password" required>
                        </label>
                        <br>
                        <label for="confirmPassword">
                            <p>Confirmar contraseña:</p>
                            <input type="password" name="confirmPassword" id="confirmPassword" required>
                        </label>
                        <br> 
                        <input type="submit" name="btnRegistrarse" id="btnRegistrarse" value="Registrarse">
                    </form>
                </div>
                <div class="error" id="formError">
                    
                </div>
                <p class="textoInicioSesion">¿Ya tienes cuenta de usuario? <a href="http://localhost/RapiBnB/Public/InicioSesion">Iniciar sesión</a></p>
            </div>
        </section>

        <script src="./Assets/Js/RegistroView.js"></script>
</body>
</html>

<?php
    include("../App/Views/layouts/footer.php");
?>