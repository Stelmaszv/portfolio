<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\users;
use CoreMain\auth;
use AppControler\menu;
use AppControler\projectsController;
use AppControler\contact;
use AppControler\futer;
class home extends controller{
    function main() { 
        $this->addElments();
    }
    private function addElments(){
        $this->templete->CAdd('[#MENU#]',$this->menu->render());
        $this->templete->CAdd('[#PROJECTS#]',$this->projects->render());
        $this->templete->CAdd('[#SKILS#]',$this->skills->render());
        $this->templete->CAdd('[#CONTAKT#]',$this->contact->render());
        $this->templete->CAdd('[#FUTER#]',$this->futer->render());
    }

    function onConstract(){
        $this->menu=menu::create();
        $this->menu->main();
        $this->projects=projectsController::create();
        $this->projects->main();
        $this->skills=skills::create();
        $this->skills->main();
        $this->contact=contact::create();
        $this->contact->main();
        $this->futer=futer::create();
        $this->futer->main();
    }
}

