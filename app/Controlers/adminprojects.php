<?php
namespace AppControler;
use CoreMain\controller;
use AppControler\admin;
use AppModel\projects;
use CoreMain\form;
use Corelanguage\language;
use Corehelpel\urls;
class adminprojects extends admin{
    function onConstract(){
        $this->model=new projects;
    }   
    function settings(){
        if(isset(url[1])){
            switch(method){
                case 'edit' || 'newProject':
                    $this->Settings['templeteshema']=setconrollerShema('projectedit');
                break; 
            }
        }
    }
    function main(){
        $this->addscheme();
        $this->templete->CLoop('projects',$this->model->showProjects('all'));
        $this->templete->CAdd('[#createactionname#]',language['translate']['createactionname']);
    }
    function edit(){
        $this->addscheme();
        $this->data=$this->model::faind(url[2]);
        $this->templete->CAdd('[#sectionnama#]',language::trnaslate('projecthead',false,'{name}',$this->data['name']));
        $this->templete->CAdd('[#name#]',$this->data['name']);
        $this->templete->CAdd('[#avatar#]',$this->data['photo']);
        $this->templete->CAdd('[#pl#]',$this->data['pl']);
        $this->templete->CAdd('[#eng#]',$this->data['eng']);
        $this->templete->CAdd('[#slide#]',$this->data['slide']);
        $this->templete->CAdd('[#button#]',language['translate']['buttonEdit']) ;
        $this->trnslateform();
    }
    function newProject(){
        $this->addscheme();
        $this->templete->CAdd('[#sectionnama#]',language['translate']['createmess']) ;
        $this->templete->CAdd('[#button#]',language['translate']['buttoncreate']) ;
        $this->trnslateform();
    }
    function delete(){
        $this->model::delete(url[2]);
        urls::setLocation('adminprojects');
    }
    function onPost(){
        if(isset(url[2])){
            $this->data=$this->model::faind(url[2]);
        }
        $this->form=new form(array(
            'name'=>array('name'=>'projectname','require'=>true,'type'=>'text','value'=>$_POST['projectname'],'stan'=>false,'login'=>true,'db'=>'name','erros'=>array()),
            'pl'=>array('name'=>'pl','require'=>true,'type'=>'text','value'=>$_POST['pl'],'stan'=>false,'login'=>true,'db'=>'pl','erros'=>array()),
            'eng'=>array('name'=>'eng','require'=>true,'type'=>'text','value'=>$_POST['eng'],'stan'=>false,'login'=>true,'db'=>'eng','erros'=>array()),
            'photo'=>array('name'=>'photo','require'=>false,'type'=>'file','value'=>$_FILES['photo'],'db'=>'photo','stan'=>false,'fileSettings'=>array('maxsize'=>500000,'ext'=>array('jpg','jpeg','png','svg','gif'),'url'=>'app/appdata/projects/'.$_POST['projectname']),'erros'=>array()),
            'slide'=>array('name'=>'slide','require'=>false,'type'=>'text','value'=>$_POST['slide'],'db'=>'slide','stan'=>false)
        ));
        if($this->form->validate()){
            $this->returnfunction();
        }else{
            $this->setError();
        }
        $this->shownotyfication();
    }
    private function trnslateform(){
        $this->templete->CAdd('[#projectname#]',language['translate']['projectname']);
        $this->templete->CAdd('[#photo#]',language['translate']['photo']);
        $this->templete->CAdd('[#photo#]',language['translate']['file']);
        $this->templete->CAdd('[#displ#]',language['translate']['displ']);
        $this->templete->CAdd('[#diseng#]',language['translate']['diseng']);
        $this->templete->CAdd('[#inslideno#]',language['translate']['inslideno']);
        $this->templete->CAdd('[#inslideyes#]',language['translate']['inslideyes']);
        $this->templete->CAdd('[#slide#]',language['translate']['slide']);
    }
    protected function editAction(){
        if($this->model::updata(url[2],$this->form->readyTosent())){
            $this->form->upload();
            $this->succes=true;
            $this->templete->CAdd('[#actionsucces#]',language['translate']['ediutMess']) ;
        }
    }
    protected function newProjectAction(){
        if($this->model::insert($this->form->readyTosent())){
            $this->form->upload();
            $this->succes=true;
            $this->templete->CAdd('[#actionsucces#]',language['translate']['createMess']) ;
        }
    }
}