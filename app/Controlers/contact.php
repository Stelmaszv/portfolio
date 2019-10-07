<?php
namespace AppControler;
use CoreMain\controller;
use CoreMain\form;
use Corehelpel\json;
class contact extends controller{
    function main() {
        $this->addElemnts();
    }
    function settings(){
        if(isset(url[1])){
            if(url[1]=='sendmessage'){
                $this->Settings['templete']=false;
            }
        }
    }
    function addElemnts(){
        $this->templete->CAdd('[#TEST#]','contact');
    }
    function sendmessage(){
        $this->form=new form(array(
            'name'=>array('name'=>'name','require'=>true,'min'=>3 ,'max'=>10,'type'=>'text','value'=>$_POST['name'],'stan'=>false),
            'email'=>array('name'=>'email','require'=>true,'min'=>3 ,'max'=>20,'type'=>'email','value'=>$_POST['email'],'stan'=>false),
            //'email'=>array('name'=>'email','require'=>true,'max'=>50,'min'=>12,'type'=>'email','value'=>'stelmaszv@gmail.com','stan'=>false)
        ));
        $arary=array(
            'stan'  =>false,
            'errors'=>[]
        );
        if($this->form->validate()){
            $stan['stan']='sucess';
        }else{
            $stan['errors']=$this->form->showErors();
        }
        echo json::json_encode($stan);
    }
}