<?php
    session_start();
    class session{
        static function ifLogin(){
            if(!isset($_SESSION['admin'])){
                return 0;
            }else{
                return $_SESSION['admin'];
            }
        }
        function logIn($Data){
            $sql=new sql();
            $login=$sql->escepeString($Data['login']);
            $sql->sql='SELECT * FROM `admin` where login = "'.$login.'"';

            if($sql->CountsSql()){
                $_SESSION['admin']=true;
                header('Location:admin.php');
            }else{
                header('Location:admin.php?error=login');
            }
        }
        function logOut(){
            session_destroy();
        }

    }
?>