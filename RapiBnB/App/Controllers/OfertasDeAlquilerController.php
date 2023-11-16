<?php
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/AlquileresModel.php");
    require_once("../App/Models/OfertasDeAlquilerModel.php");
    require_once("../App/Models/OfertasAceptadasModel.php");
    require_once("../App/Models/PerfilesModel.php");
    require_once("../App/Models/ReseniasModel.php");
    require_once("../App/Models/Database.php");

    class OfertasDeAlquilerController extends BaseController{
        private $alquileresModel;
        private $ofertasDeAlquilerModel;
        private $ofertasAceptadasModel;
        private $perfilesModel;
        private $reseñasModel;

        public function __construct(){
            $conection = new Database();
            $this->alquileresModel = new AlquileresModel($conection->getConection());
            $this->ofertasAceptadasModel = new OfertasAceptadasModel($conection->getConection());
            $this->ofertasDeAlquilerModel = new OfertasDeAlquilerModel($conection->getConection());
            $this->perfilesModel = new PerfilesConexion($conection->getConection());
            $this->reseñasModel = new ReseñasModel($conection->getConection());
        }

        public function guardarOferta(){
            $json;
            if(!$_SERVER["REQUEST_METHOD"] == "POST"){
                $json = json_encode(array('success'=>false, 'message'=> "No esta accediendo al metodo por post"));
            }elseif(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=> "No tienes permiso para utilizar este metodo"));
            }else{
                $errorValidacion = $this->validarDatos();
                if(!empty($errorValidacion)){
                    $json = json_encode(array('success'=>false, 'message'=> $errorValidacion));
                }else{
                    $perfilUsu = $this->perfilesModel->getByIdUser($_SESSION['idUsu']);
                    $idPerfil = $perfilUsu['idPerfil'];
                    $insert = $this->ofertasDeAlquilerModel->insertOferta(
                        $_POST['idAlq'], $idPerfil, $_POST['fechaIni'], $_POST['fechaFin'], $_POST['cantidadPersonas'],
                        $_POST['nombreCompleto'], $_POST['telNum'], $_POST['email']);
                    if($insert){
                        $json = json_encode(array('success'=>true, 'message'=> ""));
                    }else{
                        $json = json_encode(array('success'=>false, 'message'=> "Hubo un error al insertar la oferta"));
                    }
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }



        private function validarDatos(){
            if(!isset($_POST['idAlq'])){
                return "El dato idAlq no esta seteado";
            }elseif($this->alquileresModel->getById($_POST['idAlq']) === false){
                return "El alquiler no existe";
            }

            $perfilUsu = $this->perfilesModel->getByIdUser($_SESSION['idUsu']);
            if(!$this->ofertasDeAlquilerModel->checkByIdPerfil($_POST['idAlq'], $perfilUsu['idPerfil'])){
                
                return "Ya tienes una oferta pendiente para este alquiler";
            }

            if(!isset($_POST['fechaIni'])){
                return "El dato fechaIni no esta seteado";
            }elseif(!empty($_POST['fechaIni'])){
                $fechaIni = date_create_from_format('Y-m-d', $_POST['fechaIni']);
                $fechaActual = new DateTime();
                $fechaActual->format("Y-m-d");
                if($fechaIni===false){
                    return "El dato fechaIni no tiene un formato valido";
                }elseif($fechaIni < $fechaActual){
                    return "La fecha de inicio seteada es anterior a la fecha actual";
                }
            }else{
                return "La fecha de inicio esta vacia";
            }

            if(!isset($_POST['fechaFin'])){
                return "El dato fechaFin no esta seteado";
            }elseif(!empty($_POST['fechaFin'])){
                $fechaFin = date_create_from_format('Y-m-d', $_POST['fechaFin']);
                $fechaIni = date_create_from_format('Y-m-d', $_POST['fechaIni']);
                if($fechaFin===false){
                    return "El dato fechaFin no tiene un formato valido";
                }elseif($fechaFin < $fechaIni){
                    return "La fecha de fin es anterior a la fecha de inicio";
                }
            }else{
                return "La fecha de fin esta vacia";
            }

            if(!isset($_POST['cantidadPersonas'])){
                return "El dato cantidadPersonas no esta seteado";
            }elseif(!empty($_POST['cantidadPersonas'])){
                if(filter_var($_POST['cantidadPersonas'], FILTER_VALIDATE_INT) === false || $_POST['cantidadPersonas'] <= 0){
                    return "El dato cantidad de personas tiene un valor no valido";
                }
            }else{
                return "El dato cantidad de Personas esta vacio";
            }

            if(!isset($_POST['nombreCompleto'])){
                return "El dato nombreCompleto no esta seteado";
            }elseif(!empty($_POST['nombreCompleto'])){
                if(!preg_match('/^[\p{L} ]+$/u', $_POST['nombreCompleto'])){
                    return "El nombre completo no es valido";
                }
            }else{
                return "El nombre completo esta vacio";
            }

            if(!isset($_POST['telNum'])){
                return "El dato telNum no esta seteado";
            }elseif(!empty($_POST['telNum'])){
                if(!preg_match('/^\d{9,10}$/', $_POST['telNum'])){
                    return "el numero de telefono no es valido";
                }
            }else{
                return "el numero de telefono esta vacio";
            }

            if(!isset($_POST['email'])){
                return "El dato email no esta seteado";
            }elseif(!empty($_POST['email'])){
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    return "El email no es valido";
                }
            }else{
                return "El email esta vacio";
            }

            $alquiler = $this->alquileresModel->getById($_POST['idAlq']);
            if($alquiler['fechaIni'] != NULL){
                $fechaIniOferta = date_create_from_format('Y-m-d', $_POST['fechaIni']);
                $fechaIniAlquiler = date_create_from_format('Y-m-d', $alquiler['fechaIni']);
                if($fechaIniOferta < $fechaIniAlquiler){
                    return "La fecha de inicio es anterior a la fecha de inicio del alquiler";
                }
            }

            if($alquiler['fechaFin'] != NULL){
                $fechaFinOferta = date_create_from_format('Y-m-d', $_POST['fechaFin']);
                $fechaFinAlquiler =  date_create_from_format('Y-m-d', $alquiler['fechaFin']);
                if($fechaFinOferta > $fechaFinAlquiler){
                    return "La fecha de fin es anterior a la fecha de fin del alquiler";
                }
            }

            $fechaIniOferta = date_create_from_format('Y-m-d', $_POST['fechaIni']);
            $fechaFinOferta = date_create_from_format('Y-m-d', $_POST['fechaFin']);
            $intervalo = $fechaIniOferta->diff($fechaFinOferta);
            $diasTotales = $intervalo->days + 1;
            if($diasTotales < $alquiler['minTiempo'] || $diasTotales > $alquiler['maxTiempo']){
                return "La cantidad de dias no estan entre el tiempo minimo ni maximo";
            }

            if(!$this->ofertasAceptadasModel->fechaDisponible($_POST['idAlq'], $_POST['fechaIni'], $_POST['fechaFin'])){
                return "Las fechas colocadas no estan disponibles";
            }

            if($_POST['cantidadPersonas'] > $alquiler['cupo']){
                return "La cantidad de personas es mayor al cupo del alquiler";
            }
            return "";

        }

        public function verOfertasPorAlquiler(){
            if(!$this->checkSession()){
                header("location: http://localhost/RapiBnB/Public");
            }elseif(isset($_GET['idAlq'])){
                if($this->alquileresModel->checkByIdUser($_GET['idAlq'], $_SESSION['idUsu'])){
                    require_once("../App/Views/OfertasDeAlquilerView.php");
                }else{
                    header("location: http://localhost/RapiBnB/Public");
                }
            }else{
                header("location: http://localhost/RapiBnB/Public");
            }
        }


        public function getOfertasPorAlquiler(){
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=> "No tienes permiso para usar este metodo"));
            }elseif(!isset($_GET['idAlq'])){
                $json = json_encode(array('success'=>false, 'message'=> "No esta seteada la variable idAlq"));
            }else{
                $alquiler = $this->alquileresModel->getById($_GET['idAlq']);
                if($alquiler['idUsu'] != $_SESSION['idUsu']){
                    $json = json_encode(array('success'=>false, 'message'=> "No tiene permiso para consultar estos datos"));
                }else{
                    $ofertasPendientes = $this->ofertasDeAlquilerModel->getPendientesByIdAlq($_GET['idAlq']);
                    $ofertasEnProceso = $this->ofertasAceptadasModel->getEnProcesoByIdAlq($_GET['idAlq']);
                    $ofertasFinalizadas = $this->ofertasAceptadasModel->getFinalizadasByIdAlq($_GET['idAlq']);
                    $json = json_encode(array('success'=>true,'nombreAlquiler'=>$alquiler['titulo'],'ofertasPendientes'=>$ofertasPendientes,'ofertasEnProceso'=>$ofertasEnProceso,
                    'ofertasFinalizadas'=>$ofertasFinalizadas,'message'=>"No hay resultados"));
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }

        public function aceptarOferta(){
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=> "No tienes permiso para usar este metodo"));
            }elseif(!isset($_GET['idOferta'])){
                $json = json_encode(array('success'=>false, 'message'=> "No esta seteada la variable idOferta"));
            }else{
                $oferta = $this->ofertasDeAlquilerModel->getById($_GET['idOferta']);
                $alquiler = $this->alquileresModel->getById($oferta['idAlq']);
                if($oferta == false){
                    $json = json_encode(array('success'=>false, 'message'=> "No existe una oferta con ese Id"));
                }elseif($alquiler['idUsu'] != $_SESSION['idUsu']){
                    $json = json_encode(array('success'=>false, 'message'=> "No es el dueño de este alquiler"));
                }elseif(!$this->ofertasAceptadasModel->fechaDisponible($oferta['idAlq'],$oferta['fechaIni'], $oferta['fechaFin'])){
                    $json = json_encode(array('success'=>false, 'message'=> "La fecha para hacer la oferta ya no esta disponible"));
                }elseif(new DateTime($oferta['fechaIni']) <= new DateTime()){
                    $json = json_encode(array('success'=>false, 'message'=> "La fecha inicial de la oferta ya paso"));
                }elseif($this->ofertasAceptadasModel->insertOferta($oferta['idAlq'], $oferta['idPerfil'], $oferta['fechaIni'],
                $oferta['fechaFin'], $oferta['cantPersonas'], $oferta['nombre'], $oferta['telefono'], $oferta['email'])){
                    $this->ofertasDeAlquilerModel->updateEstadoAceptada($oferta['idOferta']);
                    $json = json_encode(array('success'=>true, 'message'=> "Oferta aceptada correctamente"));
                }else{
                    $json = json_encode(array('success'=>false, 'message'=> "Hubo un error al registrar la oferta"));
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }
       

        public function rechazarOferta(){ 
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=> "No tienes permiso para usar este metodo"));
            }elseif(!isset($_GET['idOferta'])){
                $json = json_encode(array('success'=>false, 'message'=> "No esta seteada la variable idOferta"));
            }else{
                $oferta = $this->ofertasDeAlquilerModel->getById($_GET['idOferta']);
                $alquiler = $this->alquileresModel->getById($oferta['idAlq']);
                if($oferta == false){
                    $json = json_encode(array('success'=>false, 'message'=> "No existe una oferta con ese Id"));
                }elseif($alquiler['idUsu'] != $_SESSION['idUsu']){
                    $json = json_encode(array('success'=>false, 'message'=> "No es el dueño de este alquiler"));
                }else{
                    $this->ofertasDeAlquilerModel->updateEstadoRechazada($oferta['idOferta']);
                    $json = json_encode(array('success'=>true, 'message'=> "Oferta rechazada correctamente"));
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }


        public function misOfertas(){
            if($this->checkSession()){
                require_once("../App/Views/MisOfertasView.php");
            }else{
                header("location: http://localhost/RapiBnB/Public/InicioSesion");
            }
        }

        public function getMisOfertas(){
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=> "No tienes permiso para usar este metodo"));
            }else{
                $perfil = $this->perfilesModel->getByIdUser($_SESSION['idUsu']);
                $idPerfil = $perfil['idPerfil'];
                $ofertasDeAlquiler = $this->ofertasDeAlquilerModel->getAllByIdPerfil($idPerfil);
                $datosOfertasTable = array();
                if($ofertasDeAlquiler !== false){
                    foreach($ofertasDeAlquiler as $oferta){
                        $datos = array();
                        $datos['idOferta'] = $oferta['idOferta'];
                        $datos['fechaIni'] = $oferta['fechaIni'];
                        $datos['fechaFin'] = $oferta['fechaFin'];
                        $datos['estado'] = $oferta['estado'];
                        $alquiler = $this->alquileresModel->getById($oferta['idAlq']);
                        $datos['titulo'] = $alquiler['titulo'];
                        $datos['ciudad'] = $alquiler['ciudad'];
                        $datosOfertasTable[] = $datos;
                    }
                }
                $ofertasAceptadas = $this->ofertasAceptadasModel->getAllByIdPerfil($idPerfil);
                $datosAceptadasTable = array();
                if($ofertasAceptadas !== false){
                    foreach($ofertasAceptadas as $oferta){
                        $datos = array();
                        $datos['id'] = $oferta['id'];
                        $datos['fechaIni'] = $oferta['fechaIni'];
                        $datos['fechaFin'] = $oferta['fechaFin'];
                        $datos['estado'] = $oferta['estado'];
                        $alquiler = $this->alquileresModel->getById($oferta['idAlq']);
                        $datos['titulo'] = $alquiler['titulo'];
                        $datos['ciudad'] = $alquiler['ciudad'];
                        $datosAceptadasTable[] = $datos;
                    }
                }
                $ofertasSinReseñas = array();
                if($ofertasAceptadas!==false){
                    foreach($ofertasAceptadas as $oferta){
                        if($oferta['estado']=='finalizado'){
                            if($this->reseñasModel->checkReseñaExistente($oferta['id']) === false){
                                $ofertasSinReseñas[] = $oferta['id'];
                            }
                        }
                    }
                }
                $json = json_encode(array('success'=>true,'ofertasPendientes'=>$datosOfertasTable,
                'ofertasAceptadas'=>$datosAceptadasTable, 'ofertasSinReseña' => $ofertasSinReseñas, 'message'=> ""));
            }
            header('Content-Type: application/json');
            echo $json;
        }


        public function fechasDisponibles(){
            $json;
            $fechaIni = null;
            $fechaFin = null;
            $fechasOfertas = null;
            $alquiler = $this->alquileresModel->getById($_GET['idAlq']);
            if($alquiler['fechaIni'] != null){
                $fechaIni = $alquiler['fechaIni'];
            }
            if($alquiler['fechaFin'] != null){
                $fechaFin = $alquiler['fechaFin'];
            }
            $ofertas = $this->ofertasAceptadasModel->getEnProcesoByIdAlq($_GET['idAlq']);
            if($ofertas != false){
                foreach($ofertas as $oferta){
                    $fechasOferta['fechaIni'] = $oferta['fechaIni'];
                    $fechasOferta['fechaFin'] = $oferta['fechaFin'];
                    $fechasOfertas[] = $fechasOferta;
                }
            }
            $json = json_encode(array('success'=>true,'fechaIni'=>$fechaIni, 'fechaFin'=>$fechaFin, 'fechasOfertas'=>$fechasOfertas,'message'=> ""));
            header('Content-Type: application/json');
            echo $json;
        }
    }

?>