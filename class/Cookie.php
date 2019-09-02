<?php
    class Cookie{
        public $Time=86400 * 30;
        function __construct(){
            if(!isset($_COOKIE['lanuage'])) {
                $this->Set('lanuage','eng');
                header('Location: index.php');
            }
        }
        public function Set($name,$value){
            setcookie($name, $value, time() + ($this->Time), "/");
        }
        public function GetCookie($name){
            return $_COOKIE[$name];
        }
    }

?>