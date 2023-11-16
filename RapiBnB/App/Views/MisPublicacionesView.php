<?php
    include("../App/Views/layouts/navbarUser.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB</title>
    <link rel="stylesheet" href="./Assets/Css/MisPublicacionesView.css">
</head>
<body>
    <section class="publicacionesSection">
        <div class="publicacionesContainer">
            <div class="publicacionesTitle">
                <h2>Mis Publicaciones</h2>
            </div>
            <div class="publicacionesBody">
                <div class="publicacionesActivasContainer">
                    <h3>Publicaciones Activas:</h3>
                    <!-- <div class="publicacionActiva" id="21">
                        <div class="publicacionImagenContainer">
                            <div class="publicacionImagen"></div>
                        </div>
                        <div class="publicacionTitleContainer">
                            <p>Alquiler Casa blanca</p>
                        </div>
                        <div class="publicacionBotonesContainer">
                            <button class="btnVer">Ver</button>
                            <button class="btnOfertas">Ofertas</button>
                            <button class="btnDesactivar">Desactivar</button>
                            <button class="btnEliminar">Eliminar</button>
                        </div>
                    </div>  -->
                </div>
                <div class="publicacionesDesactivadasContainer">
                    <h3>Publicaciones Pausadas:</h3>
                    <!-- <div class="publicacionPausada">
                        <div class="publicacionImagenContainer">
                            <div class="publicacionImagen"></div>
                        </div>
                        <div class="publicacionTitleContainer"></div>
                        <div class="publicacionBotonesContainer">
                            <button class="btnVer">Ver</button>
                            <button class="btnOfertas">Ofertas</button>
                            <button class="btnActivar">Activar</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>


    <section class="modalError" id="modalError">
        <div class="errorBox">
            <i class="bi bi-x-square  exitModal" id="exitModal"></i>
            <p class="errorModalContainer" id="errorModalContainer"></p>
        </div>
    </section>

    <script src="./Assets/Js/MisPublicacionesView.js"></script>
</body>
</html>

<?php
    include("../App/Views/layouts/footer.php");
?>