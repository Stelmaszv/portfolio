<?php
namespace helpels;
    class debag{
        static function varDump($array){
            echo '<pre>';
            echo var_dump($array);
            echo '</pre>';
        }
    }