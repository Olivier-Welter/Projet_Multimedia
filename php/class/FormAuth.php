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
            if ($this->verif()){

                $resultSet = ConnectDB::dbQRY('SELECT * FROM users where login=\''.$_POST['login'].'\' and passwd = \''.$_POST['passwd'].'\'');
                $s = Session::getInstance();
                if(count($resultSet)==1){
                    $s->set('login',$_POST['login']);
                    $s->set('status',1);
                }
                else{
                    $s->set('login','');
                    $s->set('status',0);
                }
                print_r($resultSet);
            }
        }
        var_dump($_SESSION);
    }


    public function verif(){
        $v = (($_POST['login']!='')&&($_POST['passwd']!=''));
        return $v;
    }
}
