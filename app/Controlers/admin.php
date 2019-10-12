<?php
namespace AppControler;
use CoreMain\controller;
use AppControler\adminmenu;
use AppControler\futer;
abstract class admin extends controller{
    protected  $error=false;
    protected  $succes=false;
    protected  $errorloop=array();
    protected function addscheme(){
        $this->menu= adminmenu::create();
        $this->futer=futer::create();
        $this->futer->main();
        $this->menu->main();
        $this->templete->CAdd('[#menu#]',$this->menu->render());
        $this->templete->CAdd('[#footer#]',$this->futer->render());
        $this->templete->CIf('error', false);
        $this->templete->CIf('succes',false);
    }
    protected function shownotyfication(){
        $this->templete->CLoop('errorlist',$this->errorloop);
        $this->templete->CIf('error', $this->error);
        $this->templete->CIf('succes',$this->succes);
    }
    protected function setError(){
        $this->error=true;
        $this->errorloop=$this->form->showErors();
    }
    protected function returnfunction(){
        $function=url[1].'Action';
        $this->$function();
    }
}