<?php
    include("../App/Views/layouts/navbarUser.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB Alert</title>
    <link rel="stylesheet" href="./Assets/Css/PublicacionesAlertView.css">
</head>
<body>

    <section class="checkSection">
            <div class="greenCheckContainer">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <p class="alertText">No puedes realizar otra publicación</p>
            <p class="textoSecundario">Usted ya tiene una publicación activa. Para agregar más publicaciones debe Verificar su cuenta o borrar su antigua publicación.
            </p>
                <a href="http://localhost/RapiBnB/Public/Perfil" class="enlacePerfil">
                <div class="buttonInicio">
                    <p>Verificar Cuenta</p>
                </div>
                </a>
                <a href="http://localhost/RapiBnB/Public/" class="enlacePerfil">
                <div class="buttonInicio">
                    <p>Volver al inicio</p>
                </div>
                </a>
            
        </section>
</body>
</html>

<?php
    include("../App/Views/layouts/footer.php");
?>