<?php
use CoreIoC\views;
use CoreMain\mainControler;
use CoreMain\router;
use CoreMain\routerController;
use AppControler\home;
use AppControler\login;
use CoreGard\iflogin;
use CoreGard\ifauthlevel;
router::route('home',function(){
    return home::create();
});
router::route('login',function(){
    return login::create(iflogin::create());
});
$show=new mainControler(router::createview());
echo $show->show();