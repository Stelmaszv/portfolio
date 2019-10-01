<?php
namespace AppControler;
use CoreMain\controller;
class contact extends controller{
    function main() {
        $this->addElemnts();
    }
    function addElemnts(){
        $this->templete->CAdd('[#TEST#]','contact');
    }
}