<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\users;
use CoreMain\auth;
use Corelanguage\language;
use Corehelpel\urls;
class menu extends controller{
    function main() {
        $this->addElments(); // set translate for menu
    }
    private function addElments(){
        $project=language::trnaslate('project');
        $skill=language::trnaslate('skill');
        $contakt=language::trnaslate('contakt');
        $admin=language::trnaslate('admin');
        $logout=language::trnaslate('logout');
        $changelang=language::trnaslate('changelang');
        $this->templete->CAdd('[#changelang#]',$changelang);
        $this->templete->Cloop('lanuages',config['languagelist']);
        $this->templete->CAdd('[#project#]',$project);
        $this->templete->CAdd('[#skill#]',$skill);
        $this->templete->CAdd('[#contakt#]',$contakt);
        $this->templete->CAdd('[#admnin#]',$admin);
        $this->templete->CAdd('[#logout#]',$logout);
        $this->templete->Cif('auth',auth::ifAuth());
    }
    function logout(){
        auth::logout();
        urls::home();
    }
    function changeLanguage(){
        language::changeLanguage(url[2]);
        urls::home();
    }
}

