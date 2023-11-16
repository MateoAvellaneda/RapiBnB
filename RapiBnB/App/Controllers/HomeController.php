<?php
    require_once("../App/Models/AlquileresModel.php");
    require_once("../App/Models/UsuariosModel.php");
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/Database.php");

    class HomeController extends BaseController{
        private $usuariosModel;
        public function __construct(){
            $conection = new Database();
            $this->usuariosModel = new UsuariosModel($conection->getConection());
        }

        public function index(){
            if($this->checkSession()){
                $usuarioActual = $this->usuariosModel->getById($_SESSION['idUsu']);
                if($usuarioActual['isAdmin']){
                    require_once("../App/Views/HomeView/HomeViewAdmin.php");
                }else{
                    require_once("../App/Views/HomeView/HomeViewUser.php");
                }      
            }else{
                require_once("../App/Views/HomeView/HomeViewAnonymous.php");
            }
        }

        public function ApiAlquileres(){
            
            $modeloAlquileres = new AlquileresConexion('root', 'camiones3');
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($modeloAlquileres->getAll(), JSON_PRETTY_PRINT);
            $modeloAlquileres->cerrarConexion();
                
        }
    }

?>