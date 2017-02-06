<?php

class ConnectDB
{
    //*******************************Variables membres*****************************
    private $dbType;
    private $dbUser;
    private $dbPassword;
    private $dbURL;
    private $dbName;
    private $dbConnection = NULL;

    //*******************************Constructeur*****************************
    public function __construct($dbType, $dbName, $dbURL, $dbUser, $dbPassword)
    {
        $this->__set($this->dbType,$dbType);
        $this->__set($this->dbUser,$dbUser);
        $this->__set($this->dbPassword,$dbPassword);
        $this->__set($this->dbURL,$dbURL);
        $this->__set($this->dbName,$dbName);
        $this->dbConnection = new PDO("$this->dbType:host=$this->dbURL;dbname=$this->dbName", $this->dbUser, $this->dbPassword);
    }

    //*******************************Accesseurs*****************************
    public function __get($varName)
    {
        switch($varName)
        {
            case('dbType'):
                return $this->dbType;
                break;
            case('dbUser'):
                return $this->dbUser;
                break;
            case('dbPassword'):
                return $this->dbPassword;
                break;
            case('dbURL'):
                return $this->dbURL;
                break;
            case('dbName'):
                return $this->dbName;
                break;
        }
    }

    //*******************************Mutateur*****************************
    public function __set($varName, $newVal)
    {
        switch($varName)
        {
            case('dbType'):
                $this->dbType = $newVal;
                break;
            case('dbUser'):
                $this->dbUser = $newVal;
                break;
            case('dbPassword'):
                $this->dbPassword = $newVal;
                break;
            case('dbURL'):
                $this->dbURL = $newVal;
                break;
            case('dbName'):
                $this->dbName = $newVal;
                break;
        }

        if($this->dbConnection !== NULL)
        {
            $this->dbConnection = $this->dbConnect();
        }
    }

    /*Fonction dbConnec()
    *Argument : Aucun
    *Description: Créer une connexion à la base de données selon les informations de l'objet ConnectDB.
    *
    *
    */
    private function dbConnect()
    {
        //Tentative de connexion à la base de données
        try
        {
            $this->dbConnection = new PDO("$this->dbType:host=$this->dbURL;dbname=$this->dbName", $this->dbUser, $this->dbPassword);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $pdoe)
        {
            //En cas d'exception, écriture dans le fichier de log.
            throw new CustomException($pdoe->getMessage(),$pdoe->getCode(), $pdoe->getFile(),$pdoe->getLine());
            LogFile::toLog([
                'message'=>$pdoe->getMessage(),
                'code'=>$pdoe->getCode(),
                'fichier'=>$pdoe->getFile(),
                'ligne'=>$pdoe->getLine()]);
        }
    }

    public function dbQuery($query)
    {
        try
        {
            $res = $this->dbConnection->prepare($query);
            $res->execute();

            if($res != false)
            {
                return $res->fetch(PDO::FETCH_ASSOC);
            }
            return NULL;
        }
        catch(PDOException $pdoe)
        {
            throw new CustomException($pdoe->getMessage(),$pdoe->getCode(), $pdoe->getFile(),$pdoe->getLine());
        }
    }
}