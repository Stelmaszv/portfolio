<?php
    include 'setings.php';
    include 'Include.php';
    $view = new viewAdmin('./templete/admin.htm');
    $actionGet = new actionGet($_GET);
    $postsAction= new actionPost($_POST);
    echo $view->PrepearView();
    echo $view->showErrors();

    /*
    if(!isset($_GET['action'])) {
        $view = new viewAdmin('./templete/admin.htm');
        $Session = new session();
        echo $view->PrepearView();



        if (isset($_POST['login'])) {
            $Session->logIn($_POST);
        }

        echo $view->showErrors();
        $action = new Action();
        $postsAction= new postAction();
    }
    */
?>
