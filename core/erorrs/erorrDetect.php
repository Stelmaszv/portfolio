<?php
namespace CoreErorr;
use Corehelpel\urls;
class erorrDetect{
    static function thrownew($error,$errorName){
        self::debagcheck();
        echo $errorName;
        die();
    }
    function debagcheck(){
        if(!config['debag']){
            urls::home();
            die();
        }
    }
}

