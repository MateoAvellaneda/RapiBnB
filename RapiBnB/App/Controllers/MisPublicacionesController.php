<?php
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/AlquileresModel.php");
    require_once("../App/Models/OfertasDeAlquilerModel.php");
    require_once("../App/Models/OfertasAceptadasModel.php");
    require_once("../App/Models/PerfilesModel.php");
    require_once("../App/Models/Database.php");

    class MisPublicacionesController extends BaseController{
        private $alquileresModel;
        private $ofertasDeAlquilerModel;
        private $ofertasAceptadasModel;
        private $perfilesModel;

        public function __construct() {
            $conection = new Database();
            $this->alquileresModel = new AlquileresModel($conection->getConection());
            $this->ofertasAceptadasModel = new OfertasAceptadasModel($conection->getConection());
            $this->ofertasDeAlquilerModel = new OfertasDeAlquilerModel($conection->getConection());
            $this->perfilesModel = new PerfilesConexion($conection->getConection());
        }

        public function index(){
            if($this->checkSession()){
                require_once("../App/Views/MisPublicacionesView.php");
            }else{
                header("location: http://localhost/RapiBnB/Public");
            }

        }

        public function getPublicacionesActivas(){
            $json;
            if(!$_SERVER["REQUEST_METHOD"] == "GET"){
                $json = json_encode(array('success'=>false, 'message'=> "No esta accediendo al metodo por get"));
            }elseif(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=> "No tienes permiso para utilizar este metodo"));
            }else{
                $Mispublicaciones = $this->alquileresModel->getByIdUserActivas($_SESSION['idUsu']);
                if($Mispublicaciones === false){
                    $json = json_encode(array('success'=>true,'publicaciones'=>NULL,'message'=> ""));
                }else{
                    $json = json_encode(array('success'=>true,'publicaciones'=> $Mispublicaciones,'message'=> ""));
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }

        public function getPublicacionesDesactivadas(){
            $json;
            if(!$_SERVER["REQUEST_METHOD"] == "GET"){
                $json = json_encode(array('success'=>false, 'message'=> "No esta accediendo al metodo por get"));
            }elseif(!$this->checkSession()){
                $json = json_encode(array('success'=>false, 'message'=> "No tienes permiso para utilizar este metodo"));
            }else{
                $Mispublicaciones = $this->alquileresModel->getByIdUserDesactivadas($_SESSION['idUsu']);
                if($Mispublicaciones === false){
                    $json = json_encode(array('success'=>true,'publicaciones'=>NULL,'message'=> ""));
                }else{
                    $json = json_encode(array('success'=>true,'publicaciones'=> $Mispublicaciones,'message'=> ""));
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }


        public function activarAlquiler(){
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false,'message'=> "No tienes permiso para usar esta funcion"));
            }elseif(!isset($_GET['idAlq'])){
                $json = json_encode(array('success'=>false,'message'=> "La variable idAlq no esta seteada"));
            }elseif(!$this->alquileresModel->checkByIdUser($_GET['idAlq'], $_SESSION['idUsu'])){
                $json = json_encode(array('success'=>false,'message'=> "Usted no es el dueño de este alquiler"));
            }else{
                $perfilActual = $this->perfilesModel->getByIdUser($_SESSION['idUsu']);
                if($perfilActual['verificado']){
                    $this->alquileresModel->activarAlquilerById($_GET['idAlq']);
                    $json = json_encode(array('success'=>true,'message'=> ""));
                }else{
                    $alquileresActivos =  $this->alquileresModel->getByIdUserActivas($_SESSION['idUsu']);
                    if($alquileresActivos == false){
                        $alquilerActual = $this->alquileresModel->getById($_GET['idAlq']);
                        if($alquilerActual['fechaEspera'] != null){
                            $json = json_encode(array('success'=>false,'message'=>"Este alquiler tiene un tiempo de espera para que pueda ser activado,
                            fecha final de tiempo de espera: ".$alquilerActual['fechaEspera']));
                        }else{
                            $this->alquileresModel->activarAlquilerById($_GET['idAlq']);
                            $json = json_encode(array('success'=>true,'message'=> ""));
                        }                
                    }else{
                        $json = json_encode(array('success'=>false,'message'=> "Usted ya tiene un alquiler activo y no es un usuario verificado"));
                    }
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }

        public function desactivarAlquiler(){
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false,'message'=> "No tienes permiso para usar esta funcion"));
            }elseif(!isset($_GET['idAlq'])){
                $json = json_encode(array('success'=>false,'message'=> "La variable idAlq no esta seteada"));
            }elseif(!$this->alquileresModel->checkByIdUser($_GET['idAlq'], $_SESSION['idUsu'])){
                $json = json_encode(array('success'=>false,'message'=> "Usted no es el dueño de este alquiler"));
            }else{
                $ofertasActivasEnProceso =  $this->ofertasAceptadasModel->getEnProcesoByIdAlq($_GET['idAlq']);
                if($ofertasActivasEnProceso == false){
                    $this->alquileresModel->desactivarAlquilerById($_GET['idAlq']);
                    $json = json_encode(array('success'=>true,'message'=> ""));
                }else{
                    $json = json_encode(array('success'=>false,'message'=> "No puedes desactivar el alquiler ya que hay una oferta sin finalizar"));
                }
                
            }
            header('Content-Type: application/json');
            echo $json;
        }
    }

?>