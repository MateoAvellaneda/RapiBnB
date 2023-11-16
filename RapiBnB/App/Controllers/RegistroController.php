<?php
require_once("../App/Models/UsuariosModel.php");
require_once("../App/Models/PerfilesModel.php");
require_once("../App/Models/Database.php");
require_once("../App/Controllers/BaseController.php");

    class RegistroController extends BaseController{

        public function __construct(){
        }

        public function __call($nombre_del_método, $argumentos){
            header("location: http://localhost/RapiBnB/Public/Registro");
        }

        public function index(){
            if($this->checkSession()){
                header("location: http://localhost/RapiBnB/Public"); 
            }else{
                require_once("../App/Views/RegistroView.php");
            }
        }


        public function registrar(){
            $erroresDeDatos = $this->validarPost();
            if(!empty($erroresDeDatos)){
                $json = json_encode(array('success'=>false, 'message'=> $erroresDeDatos));
            }else{
                $nombresOcupados = $this->verificarUsuarioExistente();
                if(!empty($nombresOcupados)){
                    $json = json_encode(array('success'=>false, 'message'=> $nombresOcupados));
                }else{
                    if($this->ingresarUsuario()){
                        if($this->ingresarPerfil()){
                            $json = json_encode(array('success'=>true, 'message'=> "Usuario ingresado correctamente"));
                            $this->iniciarSesion();
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=> "Error al ingresar el perfil"));
                            $username = $_POST['username'];
                            $conection = new Database();
                            $usuarioModel = new UsuariosModel($conection->getConection());
                            $usuarioModel->deleteUser($username);
                            $conection->closeConection();
                        }
                    }else{
                        $json = json_encode(array('success'=>false, 'message'=> "Error al ingresar el usuario"));
                    }
                }
            }
            header('Content-Type: application/json');
            echo $json;
        }

        public function registroExitoso(){ 
            require_once("../App/Views/RegistroExitosoView.php");   
        }


        private function verificarUsuarioExistente(){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $conection = new Database();
            $usuarioModel = new UsuariosModel($conection->getConection());
            $respuesta = $usuarioModel->checkInsertUsername($username);
            if($respuesta){
                $respuesta = $usuarioModel->checkInsertEmail($email);
                $conection->closeConection();
                if($respuesta){
                    return "";
                }else{
                    return "El correo electronico ya esta en uso";
                }
            }else{
                $conection->closeConection();
                return "El nombre de usuario ya esta en uso";
            }
        }

        private function validarPost(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $username = $email = $password = $confirmPassword = "";
                if(isset($_POST['username'])){
                    $username = $_POST['username'];
                    if(empty($username)){
                        return "El nombre de usuario esta vacio";
                    }
                }else{
                    return "La variable username no esta seteada.";
                }
                if(isset($_POST['email'])){
                    $email = $_POST['email'];
                    if(empty($email)){
                        return "El correo electronico esta vacio";
                    }
                }else{
                    return "La variable email no esta seteada";
                }
                if(isset($_POST['password'])){
                    $password = $_POST['password'];
                    if(empty($password)){
                        return "La contraseña esta vacia";
                    }
                }else{
                    return "La variable password no esta seteada";
                }
                if(isset($_POST['confirmPassword'])){
                    $confirmPassword = $_POST['confirmPassword'];
                    if(empty($confirmPassword)){
                        return "La confirmacion de la contraseña esta vacia";
                    }
                }else{
                    return "La variable confirmPassword no esta seteada";
                }
                if($password != $confirmPassword){
                    return "La contraseña y la confirmacion de contraseña no son iguales";
                }
                return "";

            }
        }

        private function ingresarUsuario(){
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ;
            $email = $_POST['email'];
            $conection = new Database();
            $usuarioModel = new UsuariosModel($conection->getConection());
            if($usuarioModel->insertUser($username, $password, $email)){
                $conection->closeConection();
                return true;
            }else{
                $conection->closeConection();
                return false;
            }
        }

        private function ingresarPerfil(){
            $username = $_POST['username'];
            $conection = new Database();
            $usuarioModel = new UsuariosModel($conection->getConection());
            $usuario = $usuarioModel->getByName($username);
            if(!$usuario){
                $conection->closeConection();
                return "Error con el usuario";
            }else{
                $perfilModel = new PerfilesConexion($conection->getConection());
                if($perfilModel->insertPerfil($usuario['idUsu'])){
                    $conection->closeConection();
                    return true;
                }else{
                    $conection->closeConection();
                    return false;
                }
            }
        }

        private function iniciarSesion(){
            session_start();
            $username = $_POST['username'];
            $conection = new Database();
            $usuarioModel = new UsuariosModel($conection->getConection());
            $usuario = $usuarioModel->getByName($username);
            $conection->closeConection();
            $_SESSION['idUsu'] = $usuario['idUsu'];
        }
    }


?>