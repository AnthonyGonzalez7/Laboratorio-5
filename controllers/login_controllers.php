<?php
require_once("models/users_models.php");
    class login_controllers{
        public static function login(){
            $msg = isset($_GET["msg"])?$_GET["msg"]:"";
            if(isset($_COOKIE["correo"])){
                $_SESSION["correo"] = $_COOKIE["correo"];
                $_SESSION["nombre"] =$_COOKIE["nombre"];
                header("location:index.php?c=".seg::codificar("contenido")."&m=".seg::codificar("contenido"));
            }
            $title = "Login | Laboratorio 5";
            require_once("views/estructuras/header.php");   
            require_once("views/estructuras/navlogin.php");  
            require_once("views/contenido/login.php");
            require_once("views/estructuras/footer2.php");

        }

        public static function validar() {
            if($_POST){
               
            $obj = new users_models($_POST["txtcorreo"],$_POST["txtpassword"],"","");
            $resultado = $obj->validacion_usuario();
            if(count($resultado)>0){
                $_SESSION["correo"] = $resultado["correo"];
                $_SESSION["nombre"] = $resultado["nombre"];
                if(isset($_POST["ck_check"])){
                    setcookie("correo",seg::codificar($resultado["correo"]),time()+60);
                    setcookie("nombre",seg::codificar($resultado["nombre"]),time()+60);
                }
                call_user_func("contenido_controllers::contenido");
            }else
                header("location:index.php?c=".seg::codificar("login")."&m=".seg::codificar("login")."&msg=Correo o Password incorrecto");
            }
        }

        public static function cerrar_sesion(){
            session_destroy();
            setcookie("correo",$resultado2["correo"],time()-60);
            header("location:index.php");
        }


    }
?>