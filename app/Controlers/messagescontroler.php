<?php
namespace AppControler;
use CoreMain\controller;
use AppControler\admin;
use AppModel\messages;
class messagescontroler extends admin{
    function onConstract(){
        $this->model=new messages();
    }
    public function main() {
        $this->addscheme();
        $this->templete->Cloop('mess',$this->model::showAll());
    }

    
}