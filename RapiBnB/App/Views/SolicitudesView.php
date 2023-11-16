<?php
    include("../App/Views/layouts/navbarAdmin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB Solicitudes</title>
    <link rel="stylesheet" href="../Assets/Css/SolicitudesView.css">
</head>
<body>
    <section class="solicitudesSection">
        <div class="solicitudesBodyContainer">
            <div class="solicitudesTitle">
                <h1>Solicitudes de Verificación:</h1>
            </div>
            <div class="solicitudesTableContainer">
                <table class="tableSolicitudes">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>tipo Doc</th>
                        <th>Documento</th>
                        <th>Foto frente</th>
                        <th>Foto dorso</th>
                        <th>Opciones</th>
                    </tr>
                    <!-- <tr>
                        <td>Mateo</td>
                        <td>Avellaneda</td>
                        <td>DNI</td>
                        <td>42690959</td>
                        <td><div class="imagenFrenteContainer"></div></td>
                        <td><div class="imagenDorsoContainer"></div></td>
                        <td class="btnsTable">
                            <button class="btnAceptar">Aceptar</button>
                            <button class="btnRechazar">Rechazar</button>
                        </td>
                    </tr> -->
                </table>
            </div>
        </div>
    </section>

    <section class="modalImages">
        <div class="imageContainer">
            <i class="bi bi-x-square  exitModal" id="exitModal"></i>
        </div>
    </section>

    <script src="../Assets/Js/SolicitudesView.js"></script>
</body>
</html>


<?php
    include("../App/Views/layouts/footer.php");
?>