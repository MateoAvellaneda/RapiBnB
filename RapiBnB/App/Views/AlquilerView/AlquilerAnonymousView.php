<?php 
    include("../App/Views/layouts/navbarAnonymous.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>RapiBnB Alquiler</title>
    <link rel="stylesheet" href="../../Assets/Css/AlquilerView.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <link rel="stylesheet" href="../../Assets/Css/AlquilerViewAnonymous.css">
    <link rel="stylesheet" href="../../Assets/jquery-ui-1.13.2.custom/jquery-ui.min.css">
    <script src="../../Assets/Js/jquery-3.7.1.min.js"></script>
    <script src="../../Assets/jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>
</head>
<body>
    <section class="alquilerSection">
        <div class="alquilerContainer">
            <div class="alquilerTitularContainer"> 
                <div class="titularIzquierdo">
                    <p class="ciudadAlquiler" id="ciudadAlquiler"></p>
                    <span>, </span>
                    <p class="provinciaAlquiler" id="provinciaAlquiler"></p>
                    <h2 class="tituloAlquiler" id="tituloAlquiler"></h2>
                    <p class="descripcionAlquiler" id="descripcionAlquiler"></p>
                </div>
                <div class="titularDerecho">
                    <div class="btnGuardarEnFavoritos">
                        <i class="bi bi-suit-heart-fill"></i>
                        <span>Guardar</span>
                    </div>
                    <div class="btnOfertarAlquiler">
                        <p>Ofertar Alquiler</p>
                    </div>
                    <div class="precioAlquiler">
                        <p class="precio" id="precioAlquiler"></p>
                    </div>
                </div> 
            </div>
            <div class="alquilerFotosContainer">
                <h2>Fotos:</h2>
                <div class="fotoGrandeContainer" id="fotoGrandeContainer">
                </div>
                <div class="fotosPequeñasContainer" id="fotosPequeñasContainer">

                </div>
            </div>
            <div class="alquilerInfoContainer">
                <div class="infoIzquierda">
                    <h2 class="infoTitle">Información del alquiler</h2>
                    <div class="tableInfo">
                        <div class="tableInfoIzquierdo">
                            <div class="tableItem tableProvincia">
                                <p class="tableItemSubtitle">Provincia:</p>    
                                <p class="tableItemContent" id="provinciaAlquiler2"></p>
                            </div>
                            <div class="tableItem tableCiudad">
                                <p class="tableItemSubtitle">Ciudad:</p>
                                <p class="tableItemContent" id="ciudadAlquiler2"></p>
                            </div>
                            <div class="tableItem tableTiempoMin">
                                <p class="tableItemSubtitle">Tiempo mínimo de estadía:</p>
                                <p class="tableItemContent" id="tiempoMinAlquiler"></p>    
                            </div>
                            <div class="tableItem tableTiempoMax">
                                <p class="tableItemSubtitle">Tiempo máximo de estadía:</p>
                                <p class="tableItemContent" id="tiempoMaxAlquiler"></p>    
                            </div>
                            <div class="tableItem tableFechaInicio">
                                <p class="tableItemSubtitle">Disponible desde:</p>
                                <p class="tableItemContent" id="fechaIniAlquiler"></p>
                            </div>
                        </div>
                        <div class="tableInfoDerecho">
                            <div class="tableItem tableEtiquetas">
                                <p class="tableItemSubtitle">Etiquetas:</p>
                                <div class="etiquetasContainer" id="etiquetasAlquilerContainer">
                                </div>
                                
                            </div>
                            <div class="tableItem tableCupo">
                                <p class="tableItemSubtitle">Cupo:</p>
                                <p class="tableItemContent" id="cupoAlquiler"></p>
                            </div>
                            <div class="tableItem tableCosto">
                                <p class="tableItemSubtitle">Costo por día:</p>
                                <p class="tableItemContent" id="precioAlquiler2"></p>
                            </div>
                            <div class="tableItem tableFechaFin">
                                <p class="tableItemSubtitle">Disponible hasta:</p>
                                <p class="tableItemContent" id="fechaFinAlquiler"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="infoDerecha">
                    <h2 class="servicesTitle">Servicios</h2>
                    <div class="services">
                        <div class="servicesIzquierda">
                            <div class="service serviceGasEnv">
                                <i class="bi bi-fire"></i>
                                <p>Gas Envasado</p>
                            </div>

                            <div class="service serviceInternet">
                                <i class="bi bi-router"></i>
                                <p>Internet</p>
                            </div>

                            <div class="service serviceElectricidad">
                                <i class="bi bi-lightning-charge"></i>
                                <p>Electricidad</p>
                            </div>
                        </div>
                        <div class="servicesDerecha">
                            <div class="service serviceGasNat">
                                <i class="bi bi-fire"></i>
                                <p>Gas Natural</p>
                            </div>

                            <div class="service serviceAgua">
                                <i class="bi bi-droplet"></i>
                                <p>Agua</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="ofertarButtonContainer">
                <div class="btnOfertarAlquiler2">
                    <p>Ofertar alquiler</p>
                </div>
            </div>
            <h2>Coordenadas:</h2>
            <div class="alquilerCoordenadasContainer">
                <div id="map"></div>
            </div>

            <h3 class="tituloResenias">Reseñas:</h3>
            <div class="reseniasContainer">    
                <!-- <div class="divResenia">
                    <p class="nombreUsuResenia">sin Nombre:</p>
                    <div class="estrellasReseniaContainer">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="textoResenia">Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                        Placeat ea ipsam fugit modi voluptatum temporibus. Accusantium illum praesentium 
                        inventore modi eum accusamus officiis magni alias. Animi voluptates qui nostrum iste!</p>
                </div>
                <div class="divRespuestaResenia">
                <p class="nombreUsuResenia">Respuesta del propietario:</p>
                    
                    <p class="textoResenia">Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                        Placeat ea ipsam fugit modi voluptatum temporibus. Accusantium illum praesentium 
                        inventore modi eum accusamus officiis magni alias. Animi voluptates qui nostrum iste!</p>
                </div> -->
            </div>

            <div class="formOfertarContainer">
                <div class="formOfertarTitle">
                    <h2>Formulario ofertar</h2>
                </div>

                <div class="formOfertarBody">
                    <form action="" id="formOfertar">
                        <div class="labelsForm">
                            <div class="labelContainer">
                                <label for="datepickerFechaIni">Fecha inicial del alquiler:</label>
                            </div>
                            <div class="labelContainer">
                                <label for="datepickerFechaFin">Fecha final del alquiler:</label>
                            </div>
                            <div class="labelContainer">
                                <label for="cantidadPersonas">Cantidad de personas:</label>
                            </div>
                            <div class="labelContainer">
                                <label for="nombreCompleto">Nombre completo:</label>
                            </div>
                            <div class="labelContainer">
                                <label for="telNum">Teléfono:</label>
                            </div>
                            <div class="labelContainer">
                                <label for="email">E-mail:</label>
                            </div>
                        </div>
                        <div class="inputsForm">
                            <div class="inputContainer">
                                <input type="text" name="fechaIni" id="datepickerFechaIni" readonly>
                            </div>
                            <div class="inputContainer">
                                <input type="text" name="fechaFin" id="datepickerFechaFin" readonly>
                            </div>
                            <div class="inputContainer">
                                <input type="number" name="cantidadPersonas" id="cantidadPersonas">
                            </div>
                            <div class="inputContainer">
                                <input type="text" name="nombreCompleto" id="nombreCompleto">
                            </div>
                            <div class="inputContainer">
                                <input type="text" name="telNum" id="telNum" placeholder="+54">
                            </div>
                            <div class="inputContainer">
                                <input type="email" name="email" id="email">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="btnEnviarContainer">
                    <button class="btnEnviar" id="btnEnviar">Enviar Oferta</button>
                </div>
                <div id="respuestaFormularioContainer"></div>
            </div>

            
        </div>
        
        
    </section>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <script src="../../Assets/Js/AlquilerView.js"></script>
</body>
</html>


<?php
    include("../App/Views/layouts/footer.php");
?>