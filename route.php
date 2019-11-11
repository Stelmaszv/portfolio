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
use AppControler\about;
use AppControler\adminprojects;
use AppControler\skillsadmin;
use AppControler\messagescontroler;
use CoreGard\iflogin;
use CoreGard\ifauth;
use CoreGard\ifauthlevel;
router::route('home',function(){
    return home::create();
});
router::route('login',function(){
    return login::create(iflogin::create());
});
router::route('contact/sendmessage',function(){
    return contact::create();
});
router::route('messages',function(){
    return messagescontroler::create(ifauth::create());
});
router::route('adminprojects',function(){
    return adminprojects::create(ifauth::create());
});
router::route('adminprojects/edit/{id}/',function(){
    return adminprojects::create(ifauth::create());
});
router::route('adminprojects/delete/{id}/',function(){
    return adminprojects::create(ifauth::create());
});
router::route('adminprojects/edit/{id}/',function(){
    return adminprojects::create(ifauth::create());
});
router::route('adminprojects/newProject',function(){
    return adminprojects::create(ifauth::create());
});
router::route('skillsadmin/newSkill',function(){
    return skillsadmin::create(ifauth::create());
});
router::route('menu/logout',function(){
    return menu::create();
});
router::route('menu/logout',function(){
    return menu::create();
});
router::route('about',function(){
    return about::create();
});
router::route('skillsadmin',function(){
    return skillsadmin::create();
});
router::route('menu/changeLanguage/{lang}',function(){
    return menu::create();
});
$show=new mainControler(router::createview());
echo $show->show();