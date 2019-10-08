<?php
namespace AppControler;
use CoreMain\controller;
use CoreMain\form;
use Corehelpel\json;
use AppModel\aboutme;
class contact extends controller{
    public function main() {
        $this->addElemnts();
    }
    public function settings(){
        if(isset(url[1])){
            if(url[1]=='sendmessage'){
                $this->Settings['templete']=false;
            }
        }
    }
    public function sendmessage(){
        $this->form=new form(array(
            'name'=>array('name'=>'name','require'=>true,'min'=>3 ,'max'=>20,'type'=>'text','value'=>$_POST['name'],'stan'=>false),
            'email'=>array('name'=>'email','require'=>true,'min'=>3 ,'max'=>20,'type'=>'email','value'=>$_POST['email'],'stan'=>false),
            'subject'=>array('name'=>'subject','require'=>true,'min'=>3 ,'max'=>20,'type'=>'text','value'=>$_POST['subject'],'stan'=>false),
            'message'=>array('name'=>'message','require'=>true,'min'=>10 ,'max'=>50,'type'=>'text','value'=>$_POST['message'],'stan'=>false),
        ));
        $arary=array(
            'stan'  =>false,
            'errors'=>[]
        );
        if($this->form->validate()){
            $stan['stan']='sucess';
            $this->sentEmail();
        }else{
            $stan['stan']='failure';
            $stan['errors']=$this->form->showErors();
        }
        echo json::json_encode($stan);
    }
    private function addElemnts(){
        $data=new aboutme();
        $this->templete->CAdd('[#Contaktdata#]',language['translate']['Contaktdata']);
        $this->templete->CAdd('[#Contaktme#]',language['translate']['Contaktme']);
        $this->templete->CAdd('[#emailDB#]',$data->getData('email'));
        $this->templete->CAdd('[#phone#]',$data->getData('phone'));
        $this->templete->CAdd('[#succesmess#]',language['translate']['succesmess']);
        $this->templete->CAdd('[#name#]',language['translate']['name']);
        $this->templete->CAdd('[#email#]',language['translate']['email']);
        $this->templete->CAdd('[#subject#]',language['translate']['subject']);
        $this->templete->CAdd('[#content#]',language['translate']['content']);
        $this->templete->CAdd('[#sentform#]',language['translate']['sentmess']);
        $this->templete->CAdd('[#Close#]',language['translate']['close']);
    }
    private function sentEmail(){
        //add function email here !!
    }
}