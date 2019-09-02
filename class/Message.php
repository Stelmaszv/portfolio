<?php
    class Message{
        function __construct($action){
           $Contakt= new Contakt();
           $action['to']=$Contakt->Data['id'];
           $this->SendData=$action;
        }
        function send(){
            mail($this->SendData['to'],$this->SendData['subject'],$this->SendData['Contet'], $this->Hedder());
        }
        function Hedder(){
            return array(
                'From' => $this->SendData['Form'],
                'Reply-To' => 'webmaster@example.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );
        }
    }
?>