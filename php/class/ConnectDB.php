<?php

class ConnectDB
{
    //*******************************Variables membres*****************************
    //type de 
    private $dbType;
    private $dbUser;
    private $dbPassword;
    private $dbURL;
    private $dbName;
    private $dbConnection = NULL;
    const DBTYPE='mysql';
    const DBUSER='root';
    const DBPWD='';
    const DBURL='localhost';
    const DBNAME='maemoon_com';

    //*******************************Constructeur*****************************
    public function __construct($valDBType, $valDBName, $valDBURL, $valDBUser, $valDBPassword)
    {
        $this->__set('dbType',$valDBType);
        $this->__set('dbUser',$valDBUser);
        $this->__set('dbPassword',$valDBPassword);
        $this->__set('dbURL',$valDBURL);
        $this->__set('dbName',$valDBName);
       // echo $this->dbType.':host='.$this->dbURL.';dbname='.$this->dbName.', '.$this->dbUser.', '.$this->dbPassword;
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

    /*Fonction dbConnect()
    *Argument : Aucun
    *Description: Créer une connexion à la base de données selon les informations de l'objet ConnectDB.
    *Cette connexion est affectée à la variable membre $dbConnection.
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
    
    /*Fonction dbQuery()
    *Argument:
    *$query: chaine de caractère représentant la requete à exécuter sur la base de données.
    *
    *Description:
    *Retourne le résultat de la requete sous la forme d'un tableau de tableaux associatif'
    */
    public function dbQuery($query)
    {
        try
        {
            //prépare la requête à être exécutée.
            $res = $this->dbConnection->prepare($query);
            $res->execute();

            if($res != false)
            {
                //si la requete produit des résultat, ils sont retournés sinon la méthode retourne NULL
                return $res->fetchAll(PDO::FETCH_ASSOC);
            }
            return NULL;
        }
        catch(PDOException $pdoe)
        {
            throw new CustomException($pdoe->getMessage(),$pdoe->getCode(), $pdoe->getFile(),$pdoe->getLine());
        }
    }


    /*Fonction dbCRUD()
    *Argument:
    *$query: chaine de caractère représentant la requete à exécuter sur la base de données.
    *
    *Description:
    *Retourne le résultat de la fonction exec() cette méhode permet de gérer l'exception que peut générer exec().
    *
    */
    public function dbsCRUD($query)
    {
        try
        {
            $res = $this->dbConnection->exec($query);
            return $res;
        }
        catch(PDOException $pdoe)
        {
           echo '<p>Erreur de requete</p>';
        }
    }

    public static function dbQRY($query)
    {
        try
        {
            $dbc = new PDO(self::DBTYPE.":host=".self::DBURL.";dbname=".self::DBNAME, self::DBUSER, self::DBPWD);
            $dbc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $pdoe)
        {
            echo '<p class=error>Erreur de connexion à la base de données</p>';
            echo '<p class=error>Vérifiez les informations de connexion à la base de données</p>';
        }

        try
        {
            //prépare la requête à être exécutée.
            $res = $dbc->prepare($query);
            $res->execute();

            if($res != false)
            {
                //si la requete produit des résultat, ils sont retournés sinon la méthode retourne NULL
                return $res->fetchAll(PDO::FETCH_ASSOC);
            }
            return NULL;
        }
        catch(PDOException $pdoe)
        {
            echo '<p class="error">'.$query.'</p>';
            echo '<p class=error>ConnectDB : Erreur lors de la requête dans la base de données.</p>';
        }
    }


    //===================================
    public static function dbCRUD($query)
    {
        try
        {
            $dbc = new PDO(self::DBTYPE.":host=".self::DBURL.";dbname=".self::DBNAME, self::DBUSER, self::DBPWD);
            $dbc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $pdoe)
        {
            echo '<p class=error>Erreur de connexion à la base de données</p>';
            echo '<p class=error>Vérifiez les informations de connexion à la base de données</p>';
        }

        try
        {
            $res = $dbc->exec($query);
            return $res;
        }
        catch(PDOException $pdoe)
        {
           echo '<p class="error">'.$query.'</p>';
           echo '<p class="error">Erreur de requete</p>';
        }
    }
}