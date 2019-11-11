<?php
session_start();
use Corelanguage\language;
// language settings //
$config['defultlanguage']='eng';
$languagelist=array(
    array(
        'name'=>'english',
        'url' =>'menu/changeLanguage/eng',
    ),
    array(
        'name'=>'polski',
        'url' =>'menu/changeLanguage/pl',
    ),
);
$config['languagelist']=$languagelist;
// basic settings //
$config['debag']=true;
$config['projectname']='Portfolio';
$config['projectUrl']='http://piotrstelmaszv.byethost7.com/';
$js=array(
    'custume'            =>false,
    'nourls'             =>false,            
    'noassets'           =>false,
    'nopublic'           =>false,
    'url'                =>includeMedia(array('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js')),
    'assets'              =>includeMedia('assets/js'),
    'public'              =>includeMedia('public/js')
);
$css=array(
    'custume'            =>false,
    'nourls'             =>false,            
    'noassets'           =>false,
    'nopublic'           =>false,
    'url'                =>includeMedia(array('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')),
    'assets'             =>includeMedia('assets/css'),
    'public'             =>includeMedia('public/css')
);
$config['defultController']=array(
    'templete'         =>true,
    'requiredUrl'      =>0,
    'title'            =>$config['projectname'],
    'templeteshema'    =>false,
    'nojs'             =>false,
    'js'               =>$js,
    'nocss'            =>false,
    'css'               =>$css
);
$config['homeControler']='home';
// data base settings
$config['host']='sql301.byethost.com';
$config['username']='b7_24559365';
$config['password']='PbZ2l3etuP6hzMeybar2';
$config['dbname']='b7_24559365_portfolio';
$config['port']='3306';
// auth 
$passwordOptions = [
    'cost' => 12,
];
$auth=[
    'table'              =>'users',
    'loginField'         =>'login',
    'password'           => 'password',
    'passwordOptions'    => $passwordOptions
];
$config['auth']=$auth;

define('config',$config);
/*set Url*/
if(isset($_GET['url'])){
    $url= explode('/',$_GET['url']);
}else{
    $url=false;
}
define('controller',$url[0]);
if(isset($url[1])){
    define('method',$url[1]);
}
define('url',$url);

/* get language */
new language;
// echo language::trnaslate('like','F','{Name}','Dymka'); language schema
