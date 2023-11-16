<?php
require_once("../App/Models/PerfilesModel.php");
require_once("../App/Models/UsuariosModel.php");
require_once("../App/Models/AlquileresModel.php");
require_once("../App/Controllers/BaseController.php");
require_once("../App/Models/Database.php");

class AlquilerController extends BaseController{
    private $alquileresModel;

    public function __construct() {
        $conection = new Database();
        $this->alquileresModel = new AlquileresModel($conection->getConection());
    }

    public function index(){
        if($this->checkSession()){
            if($this->alquileresModel->checkByIdUser($_GET['idAlq'], $_SESSION['idUsu'])){
                require_once("../App/Views/AlquilerView/AlquilerUserPropietarioView.php");
            }else{
                require_once("../App/Views/AlquilerView/AlquilerUserView.php");
            }
        }else{
            require_once("../App/Views/AlquilerView/AlquilerAnonymousView.php");
        }
    }

    public function getAlquiler(){
        if(!isset($_GET['idAlq'])){
            $json = json_encode(array('success'=>false, 'message'=>'la variable idAlq no esta seteada'));
        }else{
            $datosAlquiler = $this->alquileresModel->getById($_GET['idAlq']);
            if($datosAlquiler===false){
                $json = json_encode(array('success'=>false, 'message'=>'No existe alquiler con ese numero de identificacion'));
            }else{
                $json = json_encode(array('success'=>true, 'alquiler'=>$datosAlquiler, 'message'=>''));
            }
        }
        header('Content-Type: application/json');
        echo $json;
    }
}


?>