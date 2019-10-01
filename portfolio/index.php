<?php
include 'setings.php';
include 'Include.php';
$Cookie=new Cookie();
define("language", $Cookie->GetCookie('lanuage'));
$view=new view('./templete/index.htm');
$action = new actionGet($_GET);
echo $view->PrepearView();

/*
    include 'setings.php';
    include 'Include.php';
    $Cookie=new Cookie();
    define("language", $Cookie->GetCookie('lanuage'));
    $Action=new Action($_GET);
    $view=new view('./templete/index.htm');
    echo $view->PrepearView();
*/
?>
