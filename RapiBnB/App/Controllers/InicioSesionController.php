<?php
    require_once("../App/Models/UsuariosModel.php");
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/Database.php");

    class InicioSesionController extends BaseController{
        public function __construct(){         
        }

        public function __call($nombre_del_método, $argumentos){
            header("location: http://localhost/RapiBnB/Public/InicioSesion");
        }

        public function index(){
            if($this->checkSession()){
                header("location: http://localhost/RapiBnB/Public");
            }else{
                require_once("../App/Views/InicioSesionView.php");
            }
        }

        public function IniciarSesion(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST['username']) && isset($_POST['password'])){
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    if(!empty($username) && !empty($password)){
                        if($this->verificarUsuario($username, $password)){
                            $json = json_encode(array('success'=>true, 'message'=>'Inicio de sesión exitoso'));
                            
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=>'No existe un usuario con esa contraseña'));
                        }
                    }else{
                        $json = json_encode(array('success'=>false, 'message'=>'Datos faltantes'));    
                    }
                }else{
                    $json = json_encode(array('success'=>false, 'message'=>'No tienes permiso para esta funcion'));
                }
                header('Content-Type: application/json');
                echo $json;
            }
        }

        private function verificarUsuario($username, $password){
            $conection = new Database();
            $usuarioModel = new UsuariosModel($conection->getConection());
            $respuesta = $usuarioModel->getByNamePassw($username, $password);
            $conection->closeConection();
            if($respuesta){
                session_start();
                $_SESSION['idUsu'] = $respuesta['idUsu'];
                return true;
            }else{
                return false;
            }
        }

        public function cerrarSesion(){
            if($this->checkSession()){
                session_destroy();
                header("location: http://localhost/RapiBnB/Public");
            }else{
                header("location: http://localhost/RapiBnB/Public");
            }
        }
    }
?>