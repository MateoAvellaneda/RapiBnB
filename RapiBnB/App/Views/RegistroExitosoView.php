<?php
    include("../App/Views/layouts/navbarUser.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB Registro</title>
    <link rel="stylesheet" href="../Assets/Css/RegistroExitosoView.css">
    <link rel="stylesheet" href="../Assets/Icons/bootstrap-icons-1.11.1/bootstrap-icons.css">
</head>
<body>

        <section class="checkSection">
            <div class="greenCheckContainer">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <p class="checkText">Usuario registrado correctamente</p>
            
                <a href="http://localhost/RapiBnB/Public/Perfil" class="enlacePerfil">
                <div class="buttonInicio">
                    <p>Agregar datos de Perfil</p>
                </div>
                </a>
            
        </section>
</body>
</html>

<?php
    include("../App/Views/layouts/footer.php");
?>