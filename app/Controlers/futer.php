<?php
namespace AppControler;
use CoreMain\controller;
use Corelanguage\language;
class futer extends controller{
    function main() {
        $this->addElemnts();
    }
    function addElemnts(){
        $this->templete->CAdd('[#TEST#]','futer');
        $this->templete->CLoop('lanuages',config['languagelist']);
    }
}