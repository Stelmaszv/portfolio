<?php
namespace CoreGard;
use CoreMain\gard;
use CoreMain\auth;
use Corehelpel\urls;
class ifauthlevel extends gard{
    function check($data=false){
        if(auth::ifLevel($data)){
            urls::home();
        }
    }
}