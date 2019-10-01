<?php
abstract class action{
    function __construct($action){
        if(isset($action) && count($action)>0){
            $this->getAction();
        }
    }
    abstract protected function getAction();
}
//Get Actions Main class
class actionGet extends action {
    public function getAction(){
        $action['setLanguage']=new languageAction();
        $action['SendMessage']=new MessageAction();
        $action['aboutme']=new editAboutMe();
        $action['newProject']=new newProject();
        $action['newSkill']=new newSkill();
        $action['DeleteProject']=new DeleteProject();
        $action['DeleteSkill']=new DeleteSkill();
        $action['editProject']=new editProject();
        $action['editSkill']=new editSkill();
        $action['logout']=new logoutAction();
        $action[$_GET['action']]->execute($_GET);
    }
}
//Get Actions Main class execute
abstract class actionExecute{
    function __construct(){
        $this->header='admin.php';
    }
    abstract protected function execute($action);
    public function header(){
        header('Location: '.$this->header);
    }
}
class languageAction extends actionExecute {
    function execute($Action){
        $Cookie=new Cookie();
        $Cookie->Set('lanuage',$Action['value']);
        $this->header();
    }
    function header(){
        header('Location: index.php');
    }
}
class MessageAction extends languageAction{
    public function execute($Action){
        $Message=new Message($Action);
        $Message->send();
        $this->header();
    }
}
class editAboutMe extends actionExecute{
    public function execute($Action){
        $aboutme = new showAboutMe('./templete/aboutMeForm.htm');
        return $aboutme->show();
    }
}
class newProject extends actionExecute{
    public function execute($Action){
        $aboutme = new showNewProject('./templete/newProject.htm');
        return $aboutme->show();
    }
}
class newSkill extends actionExecute{
    public function execute($Action){
        $aboutme = new showNewSkill('./templete/newSkill.htm');
        return $aboutme->show();
    }
}
class DeleteProject extends actionExecute{
    function execute($action){
        $project= new Projects();
        $project->delete($action);
        $this->header();
    }

}
class DeleteSkill extends actionExecute{
    function execute($action){
        $skill= new Skills();
        $skill->delete($action);
        $this->header();
    }
}
class editProject extends actionExecute{
    function execute($action){
        $aboutme = new editProjectView('./templete/newProject.htm');
        return $aboutme->show();
    }
}
class editSkill extends actionExecute{
    function execute($action){
        $aboutme = new editSillView('./templete/newSkill.htm');
        return $aboutme->show();
    }
}
class logoutAction extends actionExecute{
    function execute($action){
        $session= new session();
        $session->logOut();
        header('Location: admin.php');
    }
}
//Post actions Main class
class actionPost extends action{
    public function getAction(){
        $action['Edit Abut Me']=new editAbutMeAction();
        $action['New Project']=new NewProjectAction();
        $action['New skill']=new NewSkillAction();
        $action['Edit Project']=new EditProjectAction();
        $action['Edit Skill']=new EditSkillAction();
        $action['login']=new LoginAction();
        $action[$_POST['submit']]->execute($_POST);
    }
}
// Post Actions Main class execute
class editAbutMeAction extends actionExecute{
    function execute($action) {
        $data= new Contakt();
        $data->upDate($action);
    }
}
class NewProjectAction extends actionExecute{
    function execute($action){
        $project= new Projects();
        $project->newProject($action);
    }
}
class NewSkillAction extends actionExecute{
    function execute($action){
        $skill= new Skills();
        $skill->newSkil($action);
    }
}
class EditProjectAction extends actionExecute{
    function execute($action){
        $project=new Project($_GET['id']);
        $project->edit($action);
        $this->header();
    }
}
class EditSkillAction extends actionExecute{
    function execute($action){
        $skill=new Skill($_GET['id']);
        $skill->edit($action);
        $this->header();
    }
}
class LoginAction extends actionExecute{
    function execute($action){
        $session= new session();
        $session->login($action);
        $this->header();
    }
}



/*
    class Action{
        public $ActionType;
        function __construct(){
            if(isset($_GET) && count($_GET)>0){
                $this->ActionType=$_GET['action'];
                $this->GetAction();
            }
        }
        public function GetAction(){
            $action['setLanguage']=new languageAction();
            $action['SendMessage']=new MessageAction();
            $action['aboutme']=new editAboutMe();
            $action['newProject']=new newProject();
            $action['newSkill']=new newSkill();
            $action['DeleteProject']=new DeleteProject();
            $action['DeleteSkill']=new DeleteSkill();
            $action['editProject']=new editProject();
            $action['editSkill']=new editSkill();
            $action['logout']=new logoutAction();
            $action[$this->ActionType]->execute($_GET);
        }
    }

    class postAction{
        function __construct(){
            if(isset($_POST) && count($_POST)>0){
                $this->ActionType=$_POST['submit'];
                $this->GetAction($_POST);
            }
        }
        function GetAction($action){
            $action['Edit Abut Me']=new editAbutMe();
            $action['New Project']=new NewProjectAction();
            $action['New skill']=new NewSkillAction();
            $action['Edit Project']=new EditProjectAction();
            $action['Edit Skill']=new EditSkillAction();
            $action['login']=new LoginAction();
            $action[$this->ActionType]->execute($_POST);
        }
    }
    interface actionInterFace{
        public function execute($Action);
    }
    class logoutAction{
        function execute(){
            $session= new session();
            $session->logOut();
            header('Location: admin.php');
        }
    }
    class LoginAction{
        function execute(){
            $session= new session();
            $session->login($_POST);
            header('Location: admin.php');
        }
    }
    class editAboutMe implements actionInterFace {
        public function execute($Action){
            $aboutme = new showAboutMe('./templete/aboutMeForm.htm');
            return $aboutme->show();
        }
    }
    class editProject extends editAbutMe{
        public function execute($action){
            $aboutme = new editProjectView('./templete/newProject.htm');
            return $aboutme->show();
        }
    }
    class editSkill extends editAbutMe{
        public function execute($action){
            $aboutme = new editSillView('./templete/newSkill.htm');
            return $aboutme->show();
        }
    }
    class newProject extends editAbutMe{
        public function execute($Action){
            $aboutme = new showNewProject('./templete/newProject.htm');
            return $aboutme->show();
        }
    }
    class newSkill extends editAbutMe{
        public function execute($Action){
            $aboutme = new showNewSkill('./templete/newSkill.htm');
            return $aboutme->show();
        }
    }

    class languageAction{
        public function execute($Action){
            $Cookie=new Cookie();
            $Cookie->Set('lanuage',$Action['value']);
            header('Location: index.php');
        }
    }
    class editAbutMe{
        function execute($action){
            $data= new Contakt();
            $data->upDate($action);
        }
    }

    class NewProjectAction{
        function execute($action){
            $project= new Projects();
            $project->newProject($action);
        }
    }
    class DeleteProject{
        function execute($action){
            $project= new Projects();
            $project->delete($action);
            header('Location: admin.php');
        }

    }
    class DeleteSkill{
        function execute($action){
            $skill= new Skills();
            $skill->delete($action);
            header('Location: admin.php');
        }
    }
    class EditProjectAction{
        function execute($action){
            $project=new Project($_GET['id']);
            $project->edit($action);
             header('Location: admin.php');
        }
    }
    class EditSkillAction{
        function execute($action){
            $skill=new Skill($_GET['id']);
            $skill->edit($action);
            header('Location: admin.php');
        }
    }
    class NewSkillAction{
        function execute($action){
           $skill= new Skills();
           $skill->newSkil($action);
        }
    }
    class MessageAction{
        public function execute($Action){
          $Message=new Message($Action);
          $Message->send();
         // header('Location: index.php');
        }
    }
    class showErrors{
        function __construct($Actions=false){
        }
    }
*/
?>