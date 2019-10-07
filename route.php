<?php
use CoreIoC\views;
use CoreMain\mainControler;
use CoreMain\router;
use CoreMain\routerController;
use AppControler\home;
use AppControler\login;
use AppControler\admin;
use AppControler\menu;
use AppControler\contact;
use CoreGard\iflogin;
use CoreGard\ifauth;
use CoreGard\ifauthlevel;
router::route('home',function(){
    return home::create();
});
router::route('login',function(){
    return login::create(iflogin::create());
});
router::route('admin',function(){
    return admin::create(ifauth::create());
});
router::route('menu/logout',function(){
    return menu::create(ifauth::create());
});
router::route('menu/logout',function(){
    return menu::create(ifauth::create());
});
router::route('contact/sendmessage',function(){
    return contact::create();
});
router::route('menu/changeLanguage/{lang}',function(){
    return menu::create();
});
$show=new mainControler(router::createview());
echo $show->show();