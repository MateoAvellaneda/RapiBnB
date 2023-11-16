<?php
    class BaseController{

        protected function checkSession(){
            session_start();
            if(!isset($_SESSION['idUsu'])){
                return false;
            }else{
                return true;
            }
        }



    }



?>