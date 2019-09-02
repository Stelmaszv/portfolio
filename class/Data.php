<?php
    class Contakt{
        var $Data;
        var $sql;
        function __construct(){
            $sql = new sql('SELECT * FROM `aboutme`');
            $this->sql=$sql;
            $this->Data=$sql->SqlloopOne();
        }
        function upDate($array){
            $eng= $this->sql->escepeString($array['eng']);
            $pl=$this->sql->escepeString($array['pl']);
            $phone=$this->sql->escepeString($array['phone']);
            $email=$this->sql->escepeString($array['email']);
            $this->sql->MsQuery(
                'UPDATE `aboutme` SET `pl` = "'.$pl.'", `eng` = "'.$eng.'" ,`email`="'.$email.'", `phone`="'.$phone.'" WHERE `aboutme`.`id` = 1'
            );
        }
    }
    class Projects{
        function __construct(){
            $sql = new sql('SELECT * FROM `projects`');
            $this->sql=$sql;
            $this->Data=$sql->SqlloopAll();
        }
        function newProject($array){
            $name= $this->sql->escepeString($array['name']);
            $eng= $this->sql->escepeString($array['eng']);
            $pl=$this->sql->escepeString($array['pl']);
            $photo=$this->sql->escepeString($array['photo']);
            $link=$this->sql->escepeString($array['link']);
            $this->sql->MsQuery(
                'INSERT INTO `projects` (`pl`, `eng`, `name`, `img`, `link`) VALUES ("'.$pl.'", "'.$eng.'", "'.$name.'", "'.$photo.'", "'.$link.'");'
            );
        }
        function delete($action){
            $id= intval($action['id']);
            $this->sql->MsQuery(
                'DELETE FROM `projects` WHERE `projects`.`id` = '.$id.''
            );
        }
    }
    class Project{
        function __construct($id){
            $this->id=$id;
            $sql = new sql('SELECT * FROM `projects` where id = '.intval($id).'');
            $this->sql=$sql;
            $this->Data=$this->sql->SqlloopOne();
        }
        function edit($array){
            $name= $this->sql->escepeString($array['name']);
            $eng= $this->sql->escepeString($array['eng']);
            $pl=$this->sql->escepeString($array['pl']);
            $photo=$this->sql->escepeString($array['photo']);
            $link=$this->sql->escepeString($array['link']);
            $this->sql->MsQuery(
                'UPDATE `projects` SET `pl` = "'.$pl.'", `eng` = "'.$eng.'", `name` = "'.$name.'", `img` = "'.$photo.'", `link` = "'.$link.'" WHERE `projects`.`id` = '.intval($this->id).';'
            );
        }
    }
    class Skills{
        function __construct(){
            $sql = new sql('SELECT * FROM `skills`');
            $this->Data=$sql->SqlloopAll();
            $this->sql=$sql;
        }
        function newSkil($array){
            $name = $this->sql->escepeString($array['name']);
            $level = $this->sql->escepeString($array['procent']);
            $photo=$this->sql->escepeString($array['logo']);
            $this->sql->MsQuery(
                'INSERT INTO `skills` (`logo`, `name`, `procent`) VALUES ("'.$photo.'","'.$name.'","'.$level.'");'
            );
        }
        function delete($action){
            $id= intval($action['id']);
            $this->sql->MsQuery(
                'DELETE FROM `skills` WHERE `skills`.`id` = '.$id.''
            );
        }
    }
    class Skill{
        function __construct($id){
            $this->id=$id;
            $sql = new sql('SELECT * FROM `skills` where id = '.intval($id).'');
            $this->sql=$sql;
            $this->Data=$this->sql->SqlloopOne();
        }
        function edit($array){
            $name = $this->sql->escepeString($array['name']);
            $level = $this->sql->escepeString($array['procent']);
            $photo=$this->sql->escepeString($array['logo']);
            $this->sql->MsQuery(
                'UPDATE `skills` SET `logo` = "'.$photo.'", `name` = "'.$name.'", `procent` = "'.$level.'" WHERE `skills`.`id` = '.intval($this->id).';'
            );
        }
    }
?>