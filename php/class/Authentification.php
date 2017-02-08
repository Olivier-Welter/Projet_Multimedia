<?php

class Authentification
{
    //Variable membre
    private static $inst_auth;
    private $inst_session;

    //constructeur
    private function __construct()
    {
        $inst_session = Session::getInstance();
    }

    //methode
    public static function isAuth()
    {
        if(!isset($inst_session))
        {
            return false;
        } 
        return self::$inst_session->get('status');
    }

    public static function checkUser($id,$mdp)
    {
        $res = DBConnect::dbQRY("SELECT * FROM users WHERE login='".$id." AND  passwd='".$mdp."'");
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
            return self::$inst_auth; 
        }
    }
}