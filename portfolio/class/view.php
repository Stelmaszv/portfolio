<?php
    class view extends CTemplate{
        function __construct($url){
            parent::__construct($url);
            $this->setHrefs();
        }
        protected function setHrefs(){
            $this->hrefs[0] = array(
                'link' => './fontawesome/css/all.css',
            );
            $this->hrefs[1] = array(
                'link' => './scss/IGX/maincomponent.css',
            );
            $this->hrefs[2] = array(
                'link' => 'https://fonts.googleapis.com/icon?family=Material+Icons',
            );
            $this->hrefs[3] = array(
                'link' => './scss/main.css'
            );
        }
        protected function addHeder($title){
            $header= new CTemplate('./templete/heder.htm');
            $header->CAdd("[#Tittle#]",$title);
            $header->CAdd("[#SCRIPTS#]",$title);
            $header->CLoop('hrefs',$this->hrefs);
            return  $header->CGet();
        }
        Protected function addScripts($script){
            $Scripts= new CTemplate('./templete/script.htm');
            $Scripts->CAdd("[#ElemntScript#]",$script);
            return  $Scripts->CGet();
        }
        function addElments(){
            $this->CAdd("[#HEDER#]",$this->addHeder('Portfolio'));
            $this->CAdd("[#SCRIPTS#]",$this->addScripts('js/main.js'));
            $this->CAdd("[#PROJECTS#]",$this->showContet(0));
            $this->CAdd("[#SKILLS#]",$this->showContet(1));
            $this->CAdd("[#CONTACT#]",$this->showContet(2));
            $this->CAdd("[#language#]",$this->showContet(3));
            $this->CAdd("[#FOOTER#]",$this->showContet(4));
        }
        function PrepearView(){
            $this->addElments();
            return  $this->CGet();
        }
        function showContet($el){
            $loopObj=[];
            $loopObj[0]=new showProjects('./templete/projects.htm');
            $loopObj[1]=new showSkills('./templete/skills.htm');
            $loopObj[2]=new showContakt('./templete/Contakt.htm');
            $loopObj[3]=new showLanguage();
            $loopObj[4]=new showContakt('./templete/footer.htm');
           return  $loopObj[$el]->Show();
        }
    }
    class viewAdmin extends view{
        function showErrors(){
            $errorList=[];
            $errorList[] = array(
                'error' => 'login',
                'stan'  => false,
                'trnaslate'=>10,
                'errorMess'=>'Wrong login or password'
            );
            $errorOj=new erros($errorList);
            return $errorOj->show();
        }
        function addElments(){
            $this->CAdd("[#HEDER#]",$this->addHeder('Admin'));
            $this->CAdd("[#SCRIPTS#]",$this->addScripts('js/admin.js'));
            $this->CAdd("[#Error#]",$this->showErrors('Admin'));
            $this->CAdd("[#MAIN#]",$this->showContet(session::ifLogin()));
        }
        function showContet($el){
            $loopObj=[];
            $loopObj[0]=new showLoginForm('./templete/loginForm.htm');
            $loopObj[1]=new showAdninSection('./templete/adminMain.htm');
            return  $loopObj[$el]->show();
        }
    }
    class showAdninSection extends view{
        function AddElments(){
            $this->CAdd("[#PRJECTS#]",$this->showContet(0));
            $this->CAdd("[#SKILS#]",$this->showContet(1));
        }
        function showContet($el){
            $loopObj=[];
            $loopObj[0]=new showProjectsAdmin('./templete/projectsEddit.htm');
            $loopObj[1]=new showSkillsAdmin('./templete/skillsAdmin.htm');
            return  $loopObj[$el]->show();
        }
        function show(){
            $this->addElments();
            return $this->CGet();
        }
    }
    class showAboutMe extends view{
        var $action;
        function __construct($url){
            parent::__construct($url);
            $about=new Contakt();
            $this->DataContakt=$about->Data;
        }
        function addElements(){
            $this->CAdd("[#HEDER#]",$this->addHeder('Abut Me'));
            $this->CAdd('[#aboutMeEng#]',$this->DataContakt['eng']);
            $this->CAdd('[#aboutMePl#]',$this->DataContakt['pl']);
            $this->CADD('[#Email#]',$this->DataContakt['email']);
            $this->CADD('[#Phone#]',$this->DataContakt['phone']);
        }
        function show(){
            $this->addElements();
            echo $this->CGet();
        }
    }
    class editProjectView extends  showAboutMe{
        function __construct($url){
            parent::__construct($url);
            $project= new Project($_GET['id']);
            $this->DataProject=$project->Data;
        }
        function addElements(){
            $this->CAdd("[#HEDER#]",$this->addHeder('Edit '.$this->DataProject['name'].''));
            $this->CAdd('[#eng#]',$this->DataProject['eng']);
            $this->CAdd('[#pl#]',$this->DataProject['pl']);
            $this->CADD('[#name#]',$this->DataProject['name']);
            $this->CADD('[#img#]',$this->DataProject['img']);
            $this->CADD('[#link#]',$this->DataProject['link']);
            $this->CAdd("[#Action#]",'Edit Project');
        }
    }
    class editSillView extends showAboutMe{
        function __construct($url){
            parent::__construct($url);
            $project= new Skill($_GET['id']);
            $this->DataProject=$project->Data;
        }
        function addElements(){
            $this->CAdd("[#HEDER#]",$this->addHeder('Edit '.$this->DataProject['name'].''));
            $this->CAdd("[#Name#]",$this->DataProject['name']);
            $this->CAdd("[#logo#]",$this->DataProject['logo']);
            $this->CAdd("[#procent#]",$this->DataProject['procent']);
            $this->CAdd("[#Action#]",'Edit Skill');
        }
    }
    class showNewProject extends showAboutMe{
        function addElments(){
            $this->CAdd("[#HEDER#]",$this->addHeder('New Project'));
            $this->CAdd("[#Action#]",'New Project');
        }
        function show(){
            $this->addElments();
            $this->CAdd("[#HEDER#]",$this->addHeder('New Project'));
            $this->CAdd("[#Action#]",'New Project');
            echo $this->CGet();
        }
    }
    class showNewSkill extends showNewProject{
        function show(){
            $this->addElments();
            $this->CAdd("[#HEDER#]",$this->addHeder('New Skill'));
            $this->CAdd("[#Action#]",'New skill');
            echo $this->CGet();
        }
    }
    class showLoginForm extends showAdninSection{}
    class showProjects extends CTemplate{
        var $projects;
        function __construct($url){
            parent::__construct($url);
            $this->GetElements();
        }
        protected  function GetElements(){
            $contakt=new Projects();
            $this->DataProjects=array();
            $this->DataProjects=[];
            foreach($contakt->Data as $el){
                $this->DataProjects[] = array(
                    'id'      => $el['id'],
                    'CONTET'  => $el[language],
                    'name'    => $el['name'],
                    'img'     => $el['img'],
                    'link'    => $el['link'],
                );
            }
        }
        protected function AddElements(){
            $this->CADD('[#DATA#]',json_encode($this->DataProjects));
            $this->CLoop('projects',$this->DataProjects);
        }
        public function Show(){
            $this->AddElements();
            return $this->CGet();
        }
    }
    class showProjectsAdmin extends showProjects{
        protected  function GetElements(){
            $contakt=new Projects();
            $this->DataProjects=array();
            $this->DataProjects=[];
            foreach($contakt->Data as $el){
                $this->DataProjects[] = array(
                    'id'      => $el['id'],
                    'pl'      => $el['pl'],
                    'eng'     => $el['eng'],
                    'name'    => $el['name'],
                    'img'     => $el['img'],
                    'link'    => $el['link'],
                );
            }
        }
        function show(){
            $this->AddElements();
            return $this->CGet();
        }
    }
    class showSkills extends showProjects{
        var $Data;
        var $Skills;
        protected function GetElements(){
            $Skills=new skills();
            $this->Skills=$Skills->Data;
            $contakt=new Contakt();
            $this->DataContakt=$contakt->Data;
       
        }
        protected function AddElements(){
            $this->CADD('[#about#]',$this->DataContakt[language]);
            $this->CADD('[#DATA#]',json_encode($this->Skills));
        }
        public function Show(){
            $this->AddElements();
            return $this->CGet();
        }

    }
    class showSkillsAdmin extends showSkills{
        protected function AddElements(){
            $this->CADD('[#aboutEng#]',$this->DataContakt['eng']);
            $this->CADD('[#aboutPL#]',$this->DataContakt['pl']);
            $this->CLoop('skills',$this->Skills);
        }
    }
    class showContakt extends showSkills{
        protected  function GetElements(){
            $contakt=new Contakt();
            $this->DataContakt=$contakt->Data;
        }
        protected function AddElements(){
            $this->CADD('[#Email#]',$this->DataContakt['email']);
            $this->CADD('[#Phone#]',$this->DataContakt['phone']);
        }
        public function Show(){
            $this->AddElements();
            return $this->CGet();
        }
    }
    class showLanguage{
        public function Show(){
            $lang = new lanuage();
            return $lang->lanuage;
        }
    }
    class Ffoter extends showSkills{
        public function Show(){
            return $this->CGet();
        }
    }
?>