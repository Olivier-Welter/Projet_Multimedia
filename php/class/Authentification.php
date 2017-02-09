<?php

class Authentification
{
    //Variable membre
    private static $inst_auth;
    private $inst_session;

    //constructeur
    private function __construct()
    {
        $this->inst_session = Session::getInstance();

    }

    //methode
    public function isAuth()
    {
        if(!isset($this->inst_session))
        {
            return false;
        }
        return $this->inst_session->get('status');
    }

    public function checkUser($id,$mdp)
    {
        $res = ConnectDB::dbQRY("SELECT * FROM users WHERE login='".$id."' AND  passwd='".$mdp."'");
        if($res != null)
        {
            return true;
        }
        return false;
    }

    public static function getInstance()
    {
        if(!self::$inst_auth)
        {
            self::$inst_auth = new self();

        }
        return self::$inst_auth;
    }
}
