<?php
namespace AppControler;
use CoreMain\controller;
use Corelanguage\language;
class adminmenu extends controller{
    function main() {
        $this->templete->CAdd('[#homeadmin#]',language['translate']['homeadmin']);
        $this->templete->CAdd('[#projects#]',language['translate']['projects']);
        $this->templete->CAdd('[#skills#]',language['translate']['skills']);
        $this->templete->CAdd('[#about#]',language['translate']['about']);
        $this->templete->CAdd('[#logout#]',language['translate']['logout']);
    }
}