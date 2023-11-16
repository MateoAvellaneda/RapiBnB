<?php
    require_once("../App/Models/PerfilesModel.php");
    require_once("../App/Models/SolicitudesDeVerificacionModel.php");
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/Database.php");
    require_once("../App/Models/UsuariosModel.php");

    class AdminController extends BaseController{
        private $perfilesModel;
        private $usuariosModel;
        private $SolicitudesModel;
        
        public function __construct(){
            $conection = new Database();
            $this->usuariosModel = new UsuariosModel($conection->getConection());
            $this->perfilesModel = new PerfilesConexion($conection->getConection());
            $this->SolicitudesModel = new SolicitudesDeVerificacionModel($conection->getConection());
        }

        public function index(){
            if($this->checkSession()){
                $usuarioActual = $this->usuariosModel->getById($_SESSION['idUsu']);
                if($usuarioActual['isAdmin']){
                    require_once("../App/Views/SolicitudesView.php");
                }else{
                    header("location: http://localhost/RapiBnB/Public");
                }
            }
        }


        public function getSolicitudes(){
            $json;
            if(!$this->checkSession()){
                $json = json_encode(array('success'=>false,'message'=> "No tienes permiso para usar esta funcion"));
            }else{
                $usuarioActual = $this->usuariosModel->getById($_SESSION['idUsu']);
                if(!$usuarioActual['isAdmin']){
                    $json = json_encode(array('success'=>false,'message'=> "No tienes permiso para usar esta funcion"));
                }else{
                    $solicitudes = $this->SolicitudesModel->getAll();
                    for($i=0; $i < count($solicitudes); $i++){
                        $perfilSolicitud = $this->perfilesModel->getById($solicitudes[$i]['idPerfil']);
                        $solicitudes[$i]['nombre'] = $perfilSolicitud['nombre'];
                        $solicitudes[$i]['apellido'] = $perfilSolicitud['apellido'];
                        $solicitudes[$i]['tipoDoc'] = $perfilSolicitud['tipoDoc'];
                        $solicitudes[$i]['numDoc'] = $perfilSolicitud['numDoc'];
                    }
                    $json = json_encode(array('success'=>true,'solicitudes'=>$solicitudes,'message'=>""));
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }


        public function aceptarSolicitud(){
            $idPerfil = $this->SolicitudesModel->getById($_POST['id']);
            $idPerfil = $idPerfil['idPerfil'];
            $this->perfilesModel->updateVerificado($idPerfil, 1);
            $this->SolicitudesModel->deleteSolicitud($_POST['id']);
            $json = json_encode(array('success'=>true,'message'=>""));
            header('Content-Type: application/json');
            echo $json;
        }

        public function rechazarSolicitud(){
            $this->SolicitudesModel->deleteSolicitud($_POST['id']);
            $json = json_encode(array('success'=>true,'message'=>""));
            header('Content-Type: application/json');
            echo $json;
        }

    }


?>