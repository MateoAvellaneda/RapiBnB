<?php
    class Alquiler{
        public $idUsu;
        public $titulo;
        public $descripcion;
        public $provincia;
        public $ciudad;
        public $coordenadas;
        public $etiquetas;
        public $fotos;
        public $servicios;
        public $costoDia;
        public $minTiempo;
        public $maxTiempo;
        public $cupo;
        public $fechaIni;
        public $fechaFin;

        public function __construct(){
            $this->idUsu = NULL;
             $this->titulo = NULL;
             $this->descripcion = NULL;
             $this->provincia = NULL;
             $this->ciudad = NULL;
             $this->coordenadas = NULL;
             $this->etiquetas = NULL;
             $this->fotos = NULL;
             $this->servicios = NULL;
             $this->costoDia = NULL;
             $this->minTiempo = NULL;
             $this->maxTiempo = NULL;
             $this->cupo = NULL;
             $this->fechaIni = NULL;
             $this->fechaFin = NULL;
        }

        public function __set($name, $value){
            $this->$name = $value;
        }

        public function __get($name){
            return $this->$name;
        }

        public function validarDatos(){
            if(isset($_POST['titulo'])){
                if(empty($_POST['titulo'])){
                    return "El campo titulo esta vacio";
                }elseif(!preg_match('/^[\p{L} ]+$/u', $_POST['titulo'])) {
                    return "El titulo tiene caracteres no validos";
                }
            }else{
                return "La variable titulo no esta seteada";
            }
            if(isset($_POST['descripcion'])){
                if(empty($_POST['descripcion'])){
                    return "El campo descripcion esta vacio";
                }
            }else{
                return "La variable descripcion no esta seteada";
            }
            $provincias = array("Buenos Aires", "Catamarca", "Chaco", "Chubut", "Córdoba", "Corrientes",
            "Entre Ríos", "Formosa", "Jujuy", "La Pampa", "La Rioja", "Mendoza", "Misiones", "Neuquén",
            "Río Negro", "Salta", "San Juan", "San Luis", "Santa Cruz", "Santa Fe", "Santiago del Estero",
            "Tierra del Fuego", "Tucumán");
            if(isset($_POST['provincia'])){
                if(empty($_POST['provincia'])){
                    return "El campo provincia esta vacio";
                }elseif(!in_array($_POST['provincia'], $provincias)){
                    return "El campo provincia tiene caracteres no validos";
                }
            }else{
                return "La variable provincia no esta seteada";
            }
            if(isset($_POST['ciudad'])){
                if(empty($_POST['ciudad'])){
                    return "El campo ciudad esta vacio";
                }elseif(!preg_match('/^[\p{L} ]+$/u', $_POST['ciudad'])) {
                    return "El campo ciudad tiene caracteres no validos";
                }
            }else{
                return "La variable ciudad no esta seteada";
            }

            if(isset($_POST['coordenadas'])){
                if(empty($_POST['coordenadas'])){
                    return "El campo coordenadas esta vacio";
                }elseif(!preg_match('/^[-+]?\d+\.\d+,\s*[-+]?\d+\.\d+$/', $_POST['coordenadas'])) {
                    return "las coordenadas tienen caracteres no validos";
                }
            }else{
                return "La variable coordenadas no esta seteada";
            }
            $etiquetas = array("Hotel", "Cabaña", "Playa", "Montañas");
            if(isset($_POST['etiquetas'])){
                if(empty($_POST['etiquetas'])){
                    return "El campo etiquetas esta vacio";
                }else{
                    foreach($_POST['etiquetas'] as $etiqueta){
                        if(!in_array($etiqueta, $etiquetas)){
                            return "Una de las etiquetas tiene caracteres no validos";
                        }
                    }
                }
            }else{
                return "La variable etiquetas no esta seteada";
            }
            if(isset($_FILES['fotos'])){
                if(empty($_FILES['fotos']['name'][0])){
                    return "El campo fotos esta vacio";
                }elseif(count($_FILES['fotos']['name']) > 5){
                    return "La cantidad de fotos es mayor que 5";
                }
            }else{
                return "La variable fotos no esta seteada";
            }
            $servicios = array("Internet", "Agua", "Gas Natural", "Gas envasado", "Electricidad");
            if(isset($_POST['servicios'])){
                if(empty($_POST['servicios'])){
                    return "El campo servicios esta vacio";
                }else{
                    foreach($_POST['servicios'] as $servicio){
                        if(!in_array($servicio, $servicios)){
                            return "Uno de los servicios tiene caracteres no validos";
                        }
                    }
                }
            }else{
                return "La variable servicios no esta seteada";
            }

            if(isset($_POST['costoPDia'])){
                if(empty($_POST['costoPDia'])){
                    return "El campo costo por dia esta vacio";
                }elseif(!($_POST['costoPDia'] > 0)) {
                    return "El costo por dia tiene que ser mayor a 0";
                }
            }else{
                return "La variable costo por dia no esta seteada";
            }

            if(isset($_POST['tiempoMin'])){
                if(empty($_POST['tiempoMin'])){
                    return "El campo tiempo minimo esta vacio";
                }elseif(!preg_match('/^[0-9]+$/', $_POST['tiempoMin'])) {
                    return "El tiempo minimo tiene caracteres no validos";
                }
            }else{
                return "La variable tiempo minimo no esta seteada";
            }

            if(isset($_POST['tiempoMax'])){
                if(empty($_POST['tiempoMax'])){
                    return "El campo tiempo maximo esta vacio";
                }elseif(!preg_match('/^[0-9]+$/', $_POST['tiempoMax'])) {
                    return "El tiempo maximo tiene caracteres no validos";
                }
            }else{
                return "La variable tiempo maximo no esta seteada";
            }

            if(isset($_POST['cupo'])){
                if(empty($_POST['cupo'])){
                    return "El campo cupo esta vacio";
                }elseif(!preg_match('/^[0-9]+$/', $_POST['cupo'])) {
                    return "El cupo tiene caracteres no validos";
                }
            }else{
                return "La variable cupo no esta seteada";
            }

            if(isset($_POST['fechaIni'])){
                if(!empty($_POST['fechaIni'])){
                    try{
                        $fecha = date_create_from_format('d/m/Y', $_POST['fechaIni']);
                    }catch(exeption $e){
                        return "La fecha de inicio no es valida";
                    }
                }
            }else{
                return "La variable fecha de inicio no esta seteada";
            }

            if(isset($_POST['fechaFin'])){
                if(!empty($_POST['fechaFin'])){
                    try{
                        $fecha = date_create_from_format('d/m/Y', $_POST['fechaFin']);
                    }catch(exeption $e){
                        return "La fecha de fin no es valida";
                    }
                }
            }else{
                return "La variable fecha de fin no esta seteada";
            }
        }

        public function extraerDatos($nombreCarpetaImagenes){
            $this->idUsu = $_SESSION['idUsu'];
            $this->titulo = $_POST['titulo'];
            $this->descripcion = $_POST['descripcion'];
            $this->provincia = $_POST['provincia'];
            $this->ciudad = $_POST['ciudad'];
            $this->coordenadas = $_POST['coordenadas'];
            $this->etiquetas = implode(",", $_POST['etiquetas']);
            $errorFotos = $this->guardarFotos($nombreCarpetaImagenes);
            if(!empty($errorFotos)){
                return $errorFotos;
            }
            $this->servicios = implode(",", $_POST['servicios']);
            $this->costoDia = $_POST['costoPDia'];
            $this->minTiempo = $_POST['tiempoMin'];
            $this->maxTiempo = $_POST['tiempoMax'];
            $this->cupo = $_POST['cupo'];
            if(!empty($_POST['fechaIni'])){
                $fechaAux = date_create_from_format('Y-m-d', $_POST['fechaIni']);
                $this->fechaIni = date_format($fechaAux, 'Y-m-d');
            }
            if(!empty($_POST['fechaFin'])){
                $fechaAux = date_create_from_format('Y-m-d', $_POST['fechaFin']);
                $this->fechaFin = date_format($fechaAux, 'Y-m-d');
            }
        }

        private function guardarFotos($nombreCarpetaImagenes){
            $direccionFotos = "/App/Images/fotosPublicaciones/";
            $carpetaFotosPublicacion = $direccionFotos . $nombreCarpetaImagenes;
            if(!file_exists("..".$carpetaFotosPublicacion)){
               if (!mkdir("..".$carpetaFotosPublicacion)){
                    return "Error al crear la carpeta de fotos";
               }
            }
            $carpetaFotosPublicacion .="/";
            $fotos = $_FILES['fotos'];
            $arrayFotos = array();
            for($i=0; $i<count($fotos['name']); $i++){
                $extension = pathinfo($fotos['name'][$i], PATHINFO_EXTENSION);
                $nuevoNombreDeImagen = "foto" . ($i + 1) . "." . $extension;
                if(move_uploaded_file($fotos['tmp_name'][$i],"..".$carpetaFotosPublicacion . $nuevoNombreDeImagen)){
                    $arrayFotos[] = $nombreCarpetaImagenes . "/" . $nuevoNombreDeImagen;
                }else{
                    return "Error al mover la imagen " . $i . "a la carpeta";
                }
            }
            $this->fotos = implode(",", $arrayFotos);
        }

    }



?>