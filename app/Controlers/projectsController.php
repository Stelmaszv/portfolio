<?php
namespace AppControler;
use CoreMain\controller;
use Corelanguage\language;
use Corehelpel\urls;
use CoreMain\pagination;
use AppModel\projects;
class projectsController extends controller{
    function main() {
        $this->addElemnts();
    }
    function addElemnts(){
        $projects = new projects();
        $this->templete->CLoop('projects',$projects->showProjects('all'));
        $this->templete->CLoop('slide',$projects->showProjects('slide'));
    }
}