<?php
namespace AppControler;
use CoreMain\controller;
use CoreMain\auth;
use AppControler\menu;
use Corelanguage\language;
class login extends controller{
    function main(){
        $this->templete->CLoop('error',array());
        $this->addElements();
    }
    function settings(){
        $this->Settings['title']=language['translate']['LoginPanel'];
    }
    function addElements(){
        $this->templete->CAdd('[#LoginPlaceHolder#]',language['translate']['placeholderLogin']);
        $this->templete->CAdd('[#PasswordPlaceHolder#]',language['translate']['placeholderPassword']);
        $this->templete->CAdd('[#Login#]',language['translate']['LoginSubmit']);
        $this->templete->CAdd('[#Password#]',language['translate']['Password']);
        $this->templete->CAdd('[#MENU#]',$this->menu->render());
    }
    function onConstract(){
        $this->menu=menu::create();
        $this->menu->main();
    }
    public function onPost(){
        $auth=new auth($_POST);
        $array=$auth->loginStart();
        if($array[0]['sucess']){
            $auth->setSession($array[0]['sucess']);
        }else{
            $this->templete->CLoop('error',$array);
        }
    }
}