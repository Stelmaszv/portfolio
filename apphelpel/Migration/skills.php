<?php
namespace AppMigration;
use CoreMain\migration;

//CREATE TABLE IF NOT EXISTS users (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),login varchar(50) COLLATE utf8_polish_ci NOT NULL,password varchar(250) COLLATE utf8_polish_ci NOT NULL,level varchar(50) COLLATE utf8_polish_ci NOT NULL,email varchar(12) COLLATE utf8_polish_ci NOT NULL)
class skills extends migration{
    public function run(){
       return array(
           'table'=>'skills',
           'PRIMARYKEY'=>'id',
           'NULL'=>'NOT NULL',
           'COLLATE'=>array(
               'utf8_polish_ci',
               'NOT NULL'
           ),
           'FIELDS'=>array(
                'id'=>array('type'=>'int','lenght'=>11),
                'name'=>array('type'=>'varchar','lenght'=>100),
                'photo'=>array('type'=>'varchar','lenght'=>100),
                'procent'=>array('type'=>'varchar','lenght'=>100),
                'type'=>array('type'=>'varchar','lenght'=>20),

            )

       );
    }
}