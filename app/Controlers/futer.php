<?php
namespace AppControler;
use CoreMain\controller;
class futer extends controller{
    function main() {
        $this->addElemnts();
    }
    function addElemnts(){
        $this->templete->CAdd('[#TEST#]','futer');
    }
}