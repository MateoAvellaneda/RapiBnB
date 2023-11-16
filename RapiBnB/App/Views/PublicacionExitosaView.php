<?php
    include("../App/Views/layouts/navbarUser.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB publicar</title>
    <link rel="stylesheet" href="../Assets/Css/PublicacionExitosaView.css">
</head>
<body>

    <section class="checkSection">
            <div class="greenCheckContainer">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <p class="alertText">Publicación creada correctamente</p>
                <a href="http://localhost/RapiBnB/Public/MisPublicaciones" class="enlacePerfil">
                <div class="buttonInicio">
                    <p>Ver mis publicaciones</p>
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