<?php
    $dir_name = opendir("class");
    $index=0;
    while (($file = readdir($dir_name))){
        if($index>1){
            include 'class/'.$file;
        }
        $index++;
    } 
?>