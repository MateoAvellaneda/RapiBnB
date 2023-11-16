<?php
    include("../App/Views/layouts/navbarUser.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB</title>
    <link rel="stylesheet" href="../Assets/Css/MisOfertasView.css">
</head>
<body>
    <section class="ofertasSection">
        <div class="ofertasContainer">
            <div class="ofertasTitle">
                <h2>Ofertas de Alquiler</h2>
            </div>
            <div class="titleAlquiler">
                <h3></h3>
            </div>
            <div class="ofertasBodyContainer" id="ContainerPendientes">
                <h4>Ofertas pendientes:</h4>
                <div class="ofertaAlquiler ofertaAlquilerTitle">
                    <div class="tituloContainer">Título</div>
                    <div class="bordeTabla"></div>
                    <div class="ciudadContainer">Ciudad</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">Fecha Inicio</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">Fecha Fin</div>
                    <div class="bordeTabla"></div>
                    <div class="estadoContainer">Estado</div>
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
                <h4>Ofertas aceptadas en proceso:</h4>
                <div class="ofertaAlquiler ofertaAlquilerTitle">
                    <div class="tituloContainer">Título</div>
                    <div class="bordeTabla"></div>
                    <div class="ciudadContainer">Ciudad</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">Fecha Inicio</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">Fecha Fin</div>
                    <div class="bordeTabla"></div>
                    <div class="estadoContainer">Estado</div>
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
                    <div class="tituloContainer">Título</div>
                    <div class="bordeTabla"></div>
                    <div class="ciudadContainer">Ciudad</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaIniContainer">Fecha Inicio</div>
                    <div class="bordeTabla"></div>
                    <div class="fechaFinContainer">Fecha Fin</div>
                    <div class="bordeTabla"></div>
                    <div class="btnContainer">Reseña</div>
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

    <section class="modalResenia">
        <div class="bodyModalResenia">
            <i class="bi bi-x-square  exitModal" id="exitModal"></i>
            <form action="" method="POST" id="formResenia">
                <input type="text" name="idOferta" id="reseniaIdOferta">
                <p>Puntuación:</p>
                <div class="puntuacionContainer">
                    <input type="radio" id="punt5" name="puntuacion" value=5>
                    <label for="punt5" class="estrella"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="punt4" name="puntuacion" value=4>
                    <label for="punt4" class="estrella"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="punt3" name="puntuacion" value=3>
                    <label for="punt3" class="estrella"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="punt2" name="puntuacion" value=2>
                    <label for="punt2" class="estrella"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="punt1" name="puntuacion" value=1>
                    <label for="punt1" class="estrella"><i class="bi bi-star-fill"></i></label>
                </div>
                <p>Descripción(Opcional):</p>
                <textarea name="descripcionResenia" id="descripcionResenia" cols="50" rows="5"></textarea>
                <input type="button" id="btnEnviarResenia" value="Reseñar">
            </form>
            <div class="errorModal">
                <p id="pErrorModal"></p>
            </div>
        </div>
    </section>


    <script src="../Assets/Js/MisOfertasView.js"></script>
</body>
</html>

<?php
    include("../App/Views/layouts/footer.php");
?>