<?php
    include("../App/Views/layouts/navbarUser.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB Publicar</title>
    <link rel="stylesheet" href="./Assets/Css/PublicarAlquilerView.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     
</head>
<body>

    <section class="publicarAlquilerSection">
        <div class="publicarAlquilerContainer">
            <div class="TitleContainer">
                <h2>Formulario de publicación de alquiler</h2>
            </div>
            <div class="FormContainer">
                <form action="" class="publicarForm" id="formulario">
                    <label for="titulo">
                        <p>Título del alquiler:</p>
                        <input type="text" name="titulo" id="titulo">
                    </label>
                    <br>
                    <label for="descripcion">
                        <p>Descripción del alquiler:</p>
                        <textarea name="descripcion" id="descripcion" cols="38" rows="9"></textarea>
                    </label>
                    <br>
                    <label for="provincia">
                        <p>Provincia:</p>
                        <select name="provincia" id="provincia">
                            <option value="Buenos Aires">Buenos aires</option>
                            <option value="Catamarca">Catamarca</option>
                            <option value="Chaco">Chaco</option>
                            <option value="Chubut">Chubut</option>
                            <option value="Córdoba">Córdoba</option>
                            <option value="Corrientes">Corrientes</option>
                            <option value="Entre Ríos">Entre Ríos</option>
                            <option value="Formosa">Formosa</option>
                            <option value="Jujuy">Jujuy</option>
                            <option value="La Pampa">La Pampa</option>
                            <option value="La Rioja">La Rioja</option>
                            <option value="Mendoza">Mendoza</option>
                            <option value="Misiones">Misiones</option>
                            <option value="Neuquén">Neuquén</option>
                            <option value="Río Negro">Río Negro</option>
                            <option value="Salta">Salta</option>
                            <option value="San Juan">San Juan</option>
                            <option value="San Luis">San Luis</option>
                            <option value="Santa Cruz">Santa Cruz</option>
                            <option value="Santa Fe">Santa Fe</option>
                            <option value="Santiago del Estero">Santiago del Estero</option>
                            <option value="Tierra del Fuego">Tierra del Fuego</option>
                            <option value="Tucumán">Tucumán</option>
                        </select>
                    </label>
                    <br>
                    <label for="ciudad">
                        <p>Nombre de la Ciudad:</p>
                        <input type="text" name="ciudad" id="ciudad">
                    </label>
                    <br>
                    <label for="coordenadas">
                        <p>Coordenadas:</p>
                        <input type="text" name="coordenadas" id="coordenadas" readonly>
                        <br>
                        <div id="map"></div>
                    </label>
                    <label for="etiquetas[]">
                        <p>Etiquetas:</p>
                        <input type="checkbox" name="etiquetas[]" value="Hotel">Hotel
                        <input type="checkbox" name="etiquetas[]" value="Cabaña">Cabaña
                        <input type="checkbox" name="etiquetas[]" value="Playa">Playa
                        <input type="checkbox" name="etiquetas[]" value="Montañas">Montañas
                    </label>
                    <br>
                    <label for="fotos">
                        <p>Fotos (máximo 5 imágenes):</p> 
                        <input type="file" id="fotos" name="fotos[]" accept="image/png, image/jpeg, image/jpg" multiple>
                    </label>
                    <br>
                    <label for="servicios[]">
                        <p>Servicios:</p>
                        <input type="checkbox" name="servicios[]" value="Internet">Internet
                        <input type="checkbox" name="servicios[]" value="Agua">Agua
                        <input type="checkbox" name="servicios[]" value="Gas Natural">Gas Natural
                        <input type="checkbox" name="servicios[]" value="Gas envasado">Gas envasado
                        <input type="checkbox" name="servicios[]" value="Electricidad">Electricidad
                    </label>
                    <br>
                    <label for="costoPDia">
                        <p>Costo por día:</p>
                        $ <input type="number" name="costoPDia" id="costoPDia" step="0.01">
                    </label>
                    <br>
                    <label for="tiempoMin">
                        <p>Tiempo mínimo de hospedaje (Días):</p>
                        <input type="number" name="tiempoMin" id="tiempoMin">
                    </label>
                    <br>
                    <label for="tiempoMax">
                        <p>Tiempo máximo de hospedaje (Días):</p>
                        <input type="number" name="tiempoMax" id="tiempoMax">
                    </label>
                    <br>
                    <label for="cupo">
                        <p>Cupo máximo de personas:</p>
                        <input type="number" name="cupo" id="cupo">
                    </label>
                    <br>
                    <label for="fechaIni">
                        <p>Fecha de inicio de la publicación (Opcional<i class="bi bi-info-circle" id="infoFechaIni"></i>):</p>
                        <input type="date" name="fechaIni" id="fechaIni">
                    </label>
                    <br>
                    <label for="fechaFin">
                        <p>Fecha de fin de la publicación (Opcional<i class="bi bi-info-circle" id="infoFechaFin"></i>):</p>
                        <input type="date" name="fechaFin" id="fechaFin">
                    </label>
                    <br>
                    <div id="formError"></div>
                    <input type="button" id="btnPublicar" value="Publicar">
                </form>
            </div>
        </div>
    </section>

    <section class="ModalInfoFechas">
        <div class="modalInfoFechasBody">
            <i class="bi bi-x-square exitModal" id="exitModal"></i>
            <div class="textModalContainer">
                <p>Si la <b>Fecha de Inicio</b> no se coloca, se toma como valor la fecha actual.</p>
                <p>Si la <b>Fecha de Fin</b> no se coloca, la publicación no tiene fecha de fin.</p>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <script src="./Assets/Js/PublicarAlquilerView.js"></script>
</body>
</html>


<?php
    include("../App/Views/layouts/footer.php");
?>