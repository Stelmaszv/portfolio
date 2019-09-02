<?php
    class erros{
        var $errorList;
        var $templeteloop;
        function __construct($array){
            $this->errorList=$array;
        }
        private function setError(){
            $index=0;
            $this->templeteloop=[];
            foreach($this->errorList as $error){
                foreach($_GET as $GET){

                    if($error['error']==$GET){
                        $this->templeteloop[] = array(
                            'error' => $this->errorList[$index]['error'],
                            'stan'  => $this->errorList[$index]['stan'],
                            'trnaslate'=>$this->errorList[$index]['trnaslate'],
                            'errorMess'=>$this->errorList[$index]['errorMess']
                        );
                    }
                }
                $index++;
            }
            
        }
        function show(){
            $this->setError();
            return $this->returnTemplete();
        }
        private function returnTemplete(){
            $error=new CTemplate('./templete/error.htm');
            $error->CLoop('errorlist',$this->templeteloop);
            return   $error->CGet();
        }
    }
?>