<?php
namespace AppControler;
use CoreMain\controller;
class skills extends controller{
    function main() {
        $this->addElemnts();
    }
    function addElemnts(){
        $this->templete->CAdd('[#TEST#]','skills');
    }
}