<?php
class FormAuth extends BaseForm {
    private $msg;

    public function __construct(){
        //connexion
        if(isset($_POST['auth'])){
            $a = Authentification::getInstance();
            if ($this->check()){
                $s = Session::getInstance();
                if($a->checkUser($_POST['login'],$_POST['passwd'])){
                    $s->set('login',$_POST['login']);
                    $s->set('status',1);
                }else{
                    $this->msg = 'Login ou mot de passe invalide';
                    $s->set('status',0);
                }
            }
        }
        //déconnexion
        if(isset($_POST['deco'])){
            $s = Session::getInstance();
            $s->stop();
            $s->start();
        }
        //génération formulaire
        $a = Authentification::getInstance();
        $this->formAttr = ['action'=>'#', 'method'=>'post', 'name'=>'authform'];
        if($a->isAuth()){
            $this->addElem('input', ['name' => "deco", 'type' => 'submit', 'value'=>'Déconnexion']);
        }else{
            $this->addElem('input', ['name' => "login", 'type' => 'text', 'placeholder'=>'login'], 'Utilisateur : ');
            $this->addElem('input', ['name' => "passwd", 'type' => 'password', 'placeholder'=>'passwd'], 'Mot de passe : ');
            $this->addElem('input', ['name' => "auth", 'type' => 'submit', 'value'=>'Authentification']);
            if(isset($_POST['auth'])){
                $this->champsAttr[0]['value'] = $_POST['login'];
                if($_POST['login']==''){
                    $this->champsAttr[0]['class'] = 'invalid';
                }
                $this->champsAttr[1]['class'] = 'invalid';
            }
        }
    }

    public function check(){
        if(($_POST['login']=='')||($_POST['passwd']=='')){
            $this->msg = 'Tous les champs doivent être remplis';
            return false;
        }
        return true;
    }

    public function getMsg(){
        return $this->msg;
    }
}
