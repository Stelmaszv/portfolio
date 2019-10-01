<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\users;
use CoreMain\auth;
use AppControler\menu;
class home extends controller{
    function main() { 
        $this->addElments();
    }
    private function addElments(){
        $this->templete->CAdd('[#MENU#]',$this->menu->render());
    }
    function onConstract(){
        $this->menu=menu::create();
        $this->menu->main();
    }
}

