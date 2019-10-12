<?php
namespace AppControler;
use CoreMain\controller;
use AppControler\admin;
use AppModel\skill;
use Corehelpel\urls;
use CoreMain\form;
class skillsadmin extends admin{
    function onConstract(){
        $this->model=new skill;
    }  
    function settings(){
        if(isset(url[1])){
            switch(method){
                case 'edit' || 'newSkill':
                    $this->Settings['templeteshema']=setconrollerShema('formskill');
                break; 
            }
        }
    }
    function main(){
        $this->addscheme();
        $this->templete->CLoop('projects',$this->model=skill::showAll());
        $this->templete->CAdd('[#createactionname#]',language['translate']['newskill']);
    }
    function edit(){
        $this->addscheme();
        $this->fillform();
    }
    function newSkill(){
        $this->addscheme();
    }
    function delete(){
        $this->model::delete(url[2]);
        urls::setLocation('skillsadmin');
    }
    function onPost(){
        if(isset(url[2])){
            $this->data=$this->model::faind(url[2]);
        }
        $this->form=new form(array(
            'name'=>array('name'=>'skill','require'=>true,'type'=>'text','value'=>$_POST['skill'],'stan'=>false,'login'=>true,'db'=>'name','erros'=>array()),
            'photo'=>array('name'=>'photo','require'=>false,'type'=>'file','value'=>$_FILES['photo'],'db'=>'photo','stan'=>false,'fileSettings'=>array('maxsize'=>500000,'ext'=>array('jpg','jpeg','png','svg','gif'),'url'=>'app/appdata/skills/'.$_POST['skill'],'newName'=>$_POST['skill']),'erros'=>array()),
            'procent'=>array('name'=>'procent','require'=>true,'type'=>'text','value'=>$_POST['procent'],'db'=>'procent','stan'=>false,'erros'=>array()),
            'type'=>array('name'=>'type','require'=>false,'type'=>'text','value'=>$_POST['type'],'db'=>'type','stan'=>false,'erros'=>array()),        
        ));
        if($this->form->validate()){
            $this->returnfunction();
        }else{
            $this->setError();
        }
        $this->shownotyfication();
    }
    private function fillform(){
        $this->data=$this->model::faind(url[2]);
        $this->templete->CAdd('[#name#]',$this->data['name']);
        $this->templete->CAdd('[#procent#]',$this->data['procent']);
    }
    protected function editAction(){
        if($this->model::updata(url[2],$this->form->readyTosent())){
            $this->form->upload();
            $this->succes=true;
            $this->templete->CAdd('[#actionsucces#]',language['translate']['ediutMess']) ;
        }
    
    }
    protected function newSkillAction(){
        if($this->model::insert($this->form->readyTosent())){
            $this->form->upload();
            $this->succes=true;
            $this->templete->CAdd('[#actionsucces#]',language['translate']['createEditMess']);
        }
    }
}