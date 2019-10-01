<?php
namespace AppControler;
use CoreMain\controller;
use Corelanguage\language;
use Corehelpel\urls;
class projects extends controller{
    function main() {
        $this->addElemnts();
    }
    function addElemnts(){
        $this->templete->CAdd('[#TEST#]','Projekty');
    }
}