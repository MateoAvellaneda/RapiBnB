<?php
    include("../App/Views/layouts/navbarUser.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiBnB Buscador</title>
    <link rel="stylesheet" href="../../Assets/Css/BuscarAlquileresView.css">
</head>
<body>
    <section class="buscadorSection">
        <div class="buscadorTitle">
            <h2>Buscador de alquileres</h2>
        </div>
        <div class="buscadorBody">
            <div class="buscadorForm">
                <form action="http://localhost/RapiBnB/Public/BuscadorAlquileres/index/" method="GET" id="formBuscar">
                    <label for="">
                        <p class="inputTitle">Título:</p>
                    </label>
                    <input type="text" name="titulo" id="titulo">
                    <label for="SelectorProvincia">
                        <p class="inputTitle">Provincia:</p>
                    </label>
                    <select name="SelectorProvincia" id="SelectorProvincia">
                        <option value="">...</option>
                        <option value="Buenos Aires">Buenos Aires</option>
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
                    <label for="etiquetas[]">
                    <p class="inputTitle">Etiquetas:</p>
                    </label>
                    <input type="checkbox" name="etiquetas[]" id="etiquetas" value="" checked style="display:none">
                    <input type="checkbox" name="etiquetas[]" id="etiquetas" value="Hotel">Hoteles <br>
                    <input type="checkbox" name="etiquetas[]" id="etiquetas" value="Cabaña">Cabañas <br>
                    <input type="checkbox" name="etiquetas[]" id="etiquetas" value="Playa">Playas <br>
                    <input type="checkbox" name="etiquetas[]" id="etiquetas" value="Montañas">Montañas <br>
                    
                    <input type="submit" value="Buscar" id="btnBuscar">
                </form>
            </div>
            <div class="cardsSection">
                
                <div class="cardsAlquileresContainer" id="cardsAlquileresContainer">
                </div>
                <div class="paginacionContainer" id="paginacion">
                </div>
            </div>
        </div>
        
    </section>

    <script src="../../Assets/Js/BuscarAlquileresView.js"></script>
</body>
</html>



<?php
    include("../App/Views/layouts/footer.php");
?>