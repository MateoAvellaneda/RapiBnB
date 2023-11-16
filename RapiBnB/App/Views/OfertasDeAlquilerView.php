<?php
    include("../App/Views/layouts/navbarUser.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB</title>
    <link rel="stylesheet" href="../../Assets/Css/OfertasDeAlquilerView.css">
</head>
<body>
    <section class="ofertasSection">
        <div class="ofertasContainer">
            <div class="ofertasTitle">
                <h2>Ofertas de Alquiler</h2>
            </div>
            <div class="titleAlquiler">
                <h3 id="tituloAlq"></h3>
            </div>
            <div class="ofertasBodyContainer" id="ContainerPendientes">
                <h4>Ofertas Pendientes:</h4>
                <div class="ofertaAlquiler ofertaAlquilerTitle">
                    <div class="nombreContainer">Nombre</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">Teléfono</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">Email</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">Personas</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">Fecha Inicio</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">Fecha Fin</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer"></div>
                </div>
                <!-- <div class="ofertaAlquiler">
                    <div class="nombreContainer">Mateo Avellaneda</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">2665030129</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">mateoAvellaneda.uni@gmail.com</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">3</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">15-06-2024</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">17-06-2024</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer">
                        <button class="btnAceptar">Aceptar</button>
                        <button class="btnRechazar">Rechazar</button>
                    </div>
                </div>
                <div class="ofertaAlquiler">
                    <div class="nombreContainer">Jose</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">Nose</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">noseJose@yahoo.com</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">2</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">05-11-2023</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">09-11-2023</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer">
                            <button class="btnAceptar">Aceptar</button>
                            <button class="btnRechazar">Rechazar</button>
                    </div>
                </div> -->
            </div>

            <div class="ofertasBodyContainer" id="ContainerEnProceso">
                <h4>Ofertas en proceso:</h4>
                <div class="ofertaAlquiler ofertaAlquilerTitle">
                    <div class="nombreContainer">Nombre</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">Teléfono</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">Email</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">Personas</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">Fecha Inicio</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">Fecha Fin</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer"></div>
                </div>
                <!-- <div class="ofertaAlquiler">
                    <div class="nombreContainer">Mateo Avellaneda</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">2665030129</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">mateoAvellaneda.uni@gmail.com</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">3</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">15-06-2024</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">17-06-2024</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer">
                    </div>
                </div>
                <div class="ofertaAlquiler">
                    <div class="nombreContainer">Jose</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">Nose</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">noseJose@yahoo.com</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">2</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">05-11-2023</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">09-11-2023</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer">
                    </div>
                </div> -->
            </div>

            <div class="ofertasBodyContainer" id="ContainerFinalizadas">
                <h4>Ofertas finalizadas:</h4>
                <div class="ofertaAlquiler ofertaAlquilerTitle">
                    <div class="nombreContainer">Nombre</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">Teléfono</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">Email</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">Personas</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">Fecha Inicio</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">Fecha Fin</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer"></div>
                </div>
                <!-- <div class="ofertaAlquiler">
                    <div class="nombreContainer">Mateo Avellaneda</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">2665030129</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">mateoAvellaneda.uni@gmail.com</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">3</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">15-06-2024</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">17-06-2024</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer">
                    </div>
                </div>
                <div class="ofertaAlquiler">
                    <div class="nombreContainer">Jose</div>
                    <div class="bordeTabla"></div>
                    <div class="telefonoContainer">Nose</div>
                    <div class="bordeTabla"></div>
                    <div class="emailContainer">noseJose@yahoo.com</div>
                    <div class="bordeTabla"></div>
                    <div class="cantPersonasContainer">2</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">05-11-2023</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">09-11-2023</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer">
                    </div>
                </div> -->
            </div>
        </div>
    </section>


    <script src="../../Assets/Js/OfertasDeAlquilerView.js"></script>
</body>
</html>

<?php
    include("../App/Views/layouts/footer.php");
?>