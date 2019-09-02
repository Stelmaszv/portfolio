<?php
    include 'setings.php';
    include 'Include.php';
    $queries = [];
    $queries[0] = 'CREATE TABLE IF NOT EXISTS aboutme (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),pl text COLLATE utf8_polish_ci NOT NULL,eng text COLLATE utf8_polish_ci NOT NULL,email varchar(50) COLLATE utf8_polish_ci NOT NULL,phone varchar(12) COLLATE utf8_polish_ci NOT NULL)';
    $queries[1] = 'CREATE TABLE IF NOT EXISTS projects (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),pl text COLLATE utf8_polish_ci NOT NULL,eng text COLLATE utf8_polish_ci NOT NULL,name varchar(50) COLLATE utf8_polish_ci NOT NULL,year varchar(4) COLLATE utf8_polish_ci NOT NULL)';
    $queries[2] = 'CREATE TABLE IF NOT EXISTS skills (id int(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`),logo varchar(50) COLLATE utf8_polish_ci NOT NULL,name varchar(50) COLLATE utf8_polish_ci NOT NULL,procent varchar(11) COLLATE utf8_polish_ci NOT NULL)';
    $sql = new sql();
    $index = 0;
    foreach($queries as $query){
        $sql->MsQuery($queries[$index]);
        $index++;
    }   
    header('Location: index.php');

?>