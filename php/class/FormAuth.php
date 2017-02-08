<?php
class FormAuth extends BaseForm {

    public function __construct(){
		$a = Authentification::getInstance(); 
	
		
        $this->formAttr = ['action'=>'#', 'method'=>'post', 'name'=>'authform'];
        $this->addElem('input', ['name' => "login", 'type' => 'text', 'placeholder'=>'login'], 'Utilisateur : ');
        $this->addElem('input', ['name' => "passwd", 'type' => 'password', 'placeholder'=>'passwd'], 'Mot de passe : ');

        $this->addElem('input', ['name' => "auth", 'type' => 'submit', 'value'=>'Authentification']);

        if(isset($_POST['auth'])){
           
            $this->champsAttr[0]['value'] = $_POST['login'];
            $this->champsAttr[1]['value'] = $_POST['passwd'];
		 
         
        }
    }


    public function verif(){
        return Validator::check_desc_search($champsAtrr[1]['value']);
    }
}
