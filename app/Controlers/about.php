<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\aboutme;
use CoreMain\form;
class about extends admin{
    function onConstract(){
        $this->model=new aboutme;
        $this->data=$this->model::faind(1);
    }   
    function main(){
        $this->templete->CIf('error', false);
        $this->templete->CIf('succes',false);
        $this->addscheme();
        $this->translateform();
        $this->fillform();
    }
    private function fillform(){
        $this->templete->CAdd('[#emialvalue#]',$this->data['email']);
        $this->templete->CAdd('[#phonevalue#]',$this->data['phone']);
        $this->templete->CAdd('[#displvalue#]',$this->data['pl']);
        $this->templete->CAdd('[#disengvalue#]',$this->data['eng']);

    }
    private function translateform(){
        $this->templete->CAdd('[#sectionnama#]',language['translate']['aboutmeedit']);
        $this->templete->CAdd('[#email#]',language['translate']['email']);
        $this->templete->CAdd('[#phone#]',language['translate']['phone']);
        $this->templete->CAdd('[#displ#]',language['translate']['displ']);
        $this->templete->CAdd('[#diseng#]',language['translate']['diseng']);
        $this->templete->CAdd('[#button#]',language['translate']['buttonEdit']);
    }
    function onPost(){
        $this->form=new form(array(
            'email'=>array('name'=>'email','require'=>true,'max'=>50,'min'=>12,'type'=>'email','value'=>$_POST['email'],'db'=>'email','stan'=>false,'erros'=>array()),
            'number'=>array('name'=>'number','require'=>true,'max'=>12,'min'=>9,'type'=>'text','value'=>$_POST['phone'],'db'=>'phone','stan'=>false,'erros'=>array()),
            'pl'=>array('name'=>'displ','require'=>true,'min'=>5,'type'=>'text','value'=>$_POST['displ'],'db'=>'pl','stan'=>false,'erros'=>array()),
            'eng'=>array('name'=>'diseng','require'=>true,'min'=>5,'type'=>'text','value'=>$_POST['diseng'],'db'=>'eng','stan'=>false,'erros'=>array()),
        ));
        if($this->form->validate()){
            if($this->model::updata(1,$this->form->readyTosent())){
                $this->templete->CAdd('[#actionsucces#]',language['translate']['ediutMess']) ;
                $this->succes=true;
            }
        }else{
            $this->setError();
        }
        $this->shownotyfication();
    }
}