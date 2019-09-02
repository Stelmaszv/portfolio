<?php
    class sql{  
        private $com;
        public $sql;
       function __construct($sql=false){
          $this->com = new mysqli(servername,username,password,dbname);
          $this->sql=$sql;
       }
       public function SqlloopOne($sql=false){
          $ret=array();
          $result = mysqli_query($this->com,$this->PrepearQuery());
          return mysqli_fetch_assoc($result);
       } 
       function SqlloopAll(){
          $ret=array();
		$result = mysqli_query($this->com,$this->PrepearQuery());
		while($text = mysqli_fetch_assoc($result)){
		     $ret[]=$text;
		}
	     return $ret;   
       }
       private function PrepearQuery($sql=false){
            $queray='';
            if(!$sql){
                $queray=$this->sql;
            }else{
                $queray=$sql;
            }
            return $queray;
       }
       public function CountsSql($sql=false){
            return count($this->SqlloopAll());
       }
       public function MsQuery($sql){
            mysqli_query($this->com, $sql);
       }
       public function escepeString($word){
            return mysqli_real_escape_string($this->com,$word);
       }
    }
?>