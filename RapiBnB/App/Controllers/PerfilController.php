<?php
    require_once("../App/Models/PerfilesModel.php");
    require_once("../App/Models/UsuariosModel.php");
    require_once("../App/Models/SolicitudesDeVerificacionModel.php");
    require_once("../App/Controllers/BaseController.php");
    require_once("../App/Models/Database.php");

    class PerfilController extends BaseController{
        private $usuarioModel;
        private $perfilModel; 
        private $solicitudesDeVerificacionModel;

        public function __construct(){
            $conection = new Database();
            $this->usuarioModel = new UsuariosModel($conection->getConection());
            $this->perfilModel = new PerfilesConexion($conection->getConection());
            $this->solicitudesDeVerificacionModel = new SolicitudesDeVerificacionModel($conection->getConection());
        }

        public function __call($nombre_del_método, $argumentos){
            header("location: http://localhost/RapiBnB/Public/Perfil");
        }

        public function index(){
            if($this->checkSession()){
                require_once("../App/Views/PerfilView.php");
            }else{
                header("location: http://localhost/RapiBnB/Public");
            }
        }

        public function editarPerfil(){
            if($this->checkSession()){
                require_once("../App/Views/EditarPerfilView.php");
            }else{
                header("location: http://localhost/RapiBnB/Public");
            }
        }

        public function getSessionPerfil(){
            if($this->checkSession()){
                $datosPerfil = $this->perfilModel->getByIdUser($_SESSION['idUsu']);
                if($datosPerfil!=false){
                    $json = json_encode(array('success'=>true, 'perfil'=>$datosPerfil, 'message'=>''));
                }else{
                    $json = json_encode(array('success'=>false, 'message'=>'Ocurrio un error al buscar el perfil'));
                }
            }else{
                $json =json_encode(array('success'=>false, 'message'=>'No tiene permisos para esta funcion'));
            }
            header('Content-Type: application/json');
            echo $json;
        }



        public function actualizarPerfil(){
            if($this->checkSession()){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $datos = $this->seleccionarDatos();
                    if(!empty($datos)){
                        $error = $this->cargarDatos($datos);
                        if(empty($error)){
                            $json = json_encode(array('success'=>true, 'message'=>'Datos cargados con exito.'));
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=>$error));
                        }
                    }else{
                        $json = json_encode(array('success'=>false, 'message'=>"No hay datos para actualizar."));
                    }
                }else{
                    $json = json_encode(array('success'=>false, 'message'=>"No se esta llamando desde un metodo GET valido."));
                }
            }else{
                $json = json_encode(array('success'=>false, 'message'=>"No tienes permiso para utilizar esta funcion."));
            }
            header('Content-Type: application/json');
            echo $json;
        }


        public function checkSolicitudVerificacion(){
            if($this->checkSession()){
                $perfil = $this->perfilModel->getByIdUser($_SESSION['idUsu']);
                if(!$perfil['verificado']){
                    if($perfil['nombre'] == NULL || $perfil['apellido'] == NULL || $perfil['tipoDoc'] == NULL
                    || $perfil['numDoc'] == NULL || $perfil['foto'] == NULL){
                        $json = json_encode(array('success'=>false, 'message'=>'debe completar todos los datos de perfil para poder enviar la solicitud de verificacion.'));
                    }else{
                        $solicitudes = $this->solicitudesDeVerificacionModel->getByIdPerfil($perfil['idPerfil']);
                        if($solicitudes === false){  
                            $json = json_encode(array('success'=>true, 'message'=>''));
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=>'Ya tiene una solicitud de verificacion en proceso de revision.'));
                        }
                    }
                }else{
                    $json = json_encode(array('success'=>false, 'message'=>'Su cuenta ya se encuentra verificada.'));
                }
            }else{
                $json = json_encode(array('success'=>false, 'message'=>'No tiene permisos para realizar esta operacion.'));
            }
            header('Content-Type: application/json');
            echo $json;
        }

        public function enviarSolicitudVerificacion(){
            session_start();
            $perfil = $this->perfilModel->getByIdUser($_SESSION['idUsu']);
            $solicitudes = $this->solicitudesDeVerificacionModel->getByIdPerfil($perfil['idPerfil']);
            $json;
                if($solicitudes === false){
                    if((!isset($_FILES['documentoFrente'])) || (!isset($_FILES['documentoDorso']))){
                        $json = json_encode(array('success'=>false, 'message'=>'El formulario esta incompleto 1.'));
                    }elseif(empty($_FILES['documentoFrente']['name'][0]) || empty($_FILES['documentoDorso']['name'][0])){
                        $json = json_encode(array('success'=>false, 'message'=>'El formulario esta incompleto 2.'));
                    }else{
                        $usuario = $this->usuarioModel->getById($_SESSION['idUsu']);
                        $nombreCarpetaImagenes = $usuario['nombreUsu'];
                        $direccionDocumentacion = "/App/Images/DocumentacionPerfil/";
                        $carpetaDocumentacionUsuario = $direccionDocumentacion . $nombreCarpetaImagenes;
                        if(!file_exists("..".$carpetaDocumentacionUsuario)){
                            if (!mkdir("..".$carpetaDocumentacionUsuario)){
                                return "Error al crear la carpeta de fotos";
                            }
                        }
                        $carpetaDocumentacionUsuario .="/";
                        $DocFrente = $_FILES['documentoFrente'];
                        $extensionFrente = pathinfo($DocFrente['name'], PATHINFO_EXTENSION);
                        $nuevoNombreFrente = "frente." . $extensionFrente;
                        $DocDorso = $_FILES['documentoDorso'];
                        $extensionDorso = pathinfo($DocDorso['name'], PATHINFO_EXTENSION);
                        $nuevoNombreDorso = "dorso." . $extensionDorso;
                        if(move_uploaded_file($DocFrente['tmp_name'],"..".$carpetaDocumentacionUsuario . $nuevoNombreFrente)){
                            if(move_uploaded_file($DocDorso['tmp_name'],"..".$carpetaDocumentacionUsuario . $nuevoNombreDorso)){
                                $nombreCarpetaImagenes .= "/";
                                $insertSolicitud = $this->solicitudesDeVerificacionModel->insertSolicitud($perfil['idPerfil'], 
                                $nombreCarpetaImagenes.$nuevoNombreFrente,$nombreCarpetaImagenes.$nuevoNombreDorso);
                                if($insertSolicitud){
                                    $json = json_encode(array('success'=>true, 'message'=>'Solicitud enviada correctamente'));
                                }else{
                                    $json = json_encode(array('success'=>false, 'message'=>'Error al cargar en la base de datos'));
                                }
                            }else{
                                $json = json_encode(array('success'=>false, 'message'=>'Error al mover la imagen del dorso'));
                            }
                        }else{
                            $json = json_encode(array('success'=>false, 'message'=>'Error al mover la imagen del frente'));
                        }
                    }               
                }else{
                    $json = json_encode(array('success'=>false, 'message'=>'Ya tiene una solicitud de verificacion en proceso de revision.'));
                }
            header('Content-Type: application/json');
            echo $json;
        }

        private function seleccionarDatos(){
            $datos = array();
            if(isset($_FILES['inputFoto'])){
                $inputImagen = $_FILES['inputFoto'];
                if(!empty($inputImagen['tmp_name'])){
                    $datos['imagen'] = $inputImagen;
                }
            }
            if(isset($_POST['inputNombre'])){
                $inputNombre = $_POST['inputNombre'];
                if(!empty($inputNombre)){
                    $datos['nombre'] = $inputNombre;
                }
            }
            if(isset($_POST['inputApellido'])){
                $inputApellido = $_POST['inputApellido'];
                if(!empty($inputApellido)){
                    $datos['apellido'] = $inputApellido;
                }
            }
            if(isset($_POST['inputTipoDoc'])){
                $inputTipoDoc = $_POST['inputTipoDoc'];
                if(!empty($inputTipoDoc)){
                    $datos['tipoDoc'] = $inputTipoDoc;
                }
            }
            if(isset($_POST['inputNumDoc'])){
                $inputNumDoc = $_POST['inputNumDoc'];
                if(!empty($inputNumDoc)){
                    $datos['numDoc'] = $inputNumDoc;
                }
            }
            if(isset($_POST['inputIntereses'])){
                $inputIntereses = $_POST['inputIntereses'];
                if(!empty($inputIntereses)){
                    foreach($inputIntereses as $interes){
                        $datos['intereses'][] = $interes;
                    }
                }
            }
            return $datos;
        }

        private function cargarDatos($datos){
            $conexion = new Database();
            $perfilModel = new PerfilesConexion($conexion->getConection());
            $usuarioModel = new UsuariosModel($conexion->getConection());
            $idUsuario = $_SESSION['idUsu'];
            foreach($datos as $key => $value){
                switch($key){
                    case 'imagen':
                        $error = $this->cargarImagen($value, $perfilModel, $usuarioModel);
                        if(!empty($error)){
                            return $error;
                        }
                        break;
                    case 'nombre':
                        if(preg_match('/^[\p{L} ]+$/u', $value)){
                            if(!$perfilModel->updateNombre($idUsuario, $value)){
                                return "Hubo un problema al cargar el nombre en la base de datos";
                            }
                        }else{
                            return "El nombre tiene caracteres no validos";
                        }
                        break;
                    case 'apellido':
                        if(preg_match('/^[\p{L} ]+$/u', $value)){
                            if(!$perfilModel->updateApellido($idUsuario, $value)){
                                return "Hubo un problema al cargar el apellido en la base de datos";
                            }
                        }else{
                            return "El apellido tiene caracteres no validos";
                        }
                        break;
                    case 'tipoDoc':
                        $opcionesPermitidas = ["DNI","Pasaporte"];
                        if(in_array($value, $opcionesPermitidas)){
                            if(!$perfilModel->updateTipoDoc($idUsuario, $value)){
                                return "Hubo un problema al cargar el tipo de documento en la base de datos";
                            }
                        }else{
                            return "El tipo de documento tiene caracteres no validos";
                        }
                        break;
                    case 'numDoc':
                        if(preg_match('/^\d{7,8}$/', $value)){
                            if(!$perfilModel->updateNumDoc($idUsuario, $value)){
                                return "Hubo un problema al cargar el numero de documento en la base de datos";
                            }
                        }else{
                            return "El numero de documento tiene caracteres no validos";
                        }
                        break;
                    case 'intereses':
                        $intereses = implode(",", $value);
                        if(!$perfilModel->updateIntereses($idUsuario, $intereses)){
                            return "Hubo un problema al cargar los intereses en la base de datos";
                        }
                        break;
                }
            }

        }

        private function cargarImagen($imagen,PerfilesConexion $perfilModel,UsuariosModel $usuarioModel){
            $idUsu = $_SESSION['idUsu'];
            $usuario = $usuarioModel->getById($idUsu);
            $nombreDeUsuario = $usuario['nombreUsu'];
            $direccionImagenes = "/App/Images/ImagenesPerfil/";
            $nombreOriginalDelArchivo = $imagen['name'];
            $extension = pathinfo($nombreOriginalDelArchivo, PATHINFO_EXTENSION);
            $nuevoNombreDelArchivo = $nombreDeUsuario . "." . $extension;
            if($imagen['error'] == UPLOAD_ERR_OK){
                if(is_uploaded_file($imagen['tmp_name'])){
                    if(move_uploaded_file($imagen['tmp_name'], ".." . $direccionImagenes . $nuevoNombreDelArchivo)){
                        if($perfilModel->updateImagen($_SESSION['idUsu'], $direccionImagenes . $nuevoNombreDelArchivo)){
                            return "";
                        }else{
                            return "Hubo un problema al cargar la imagen en la base de datos";
                        }
                    }else{
                        return "Error al mover la imagen";
                    }
                }else{
                    return "La imagen no se subio por POST";
                }
            }else{
                return "Ocurrio un error al subir la imagen";
            }
        }

    }

    

?>