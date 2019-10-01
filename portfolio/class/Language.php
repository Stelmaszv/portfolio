<?php
    class lanuage{
        public $lanuage;
        function __construct(){
            $this->SetLanguage();
        }
        private function SetLanguage(){
            $Cookie=new Cookie();
            $this->lanuage=$Cookie->GetCookie('lanuage');
        }
    }
?>