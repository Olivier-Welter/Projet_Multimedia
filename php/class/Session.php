<?php 
class Session { 
    private static $instance; 
    private $nom = 'DEF_SESSID'; 
    // le nom de la variable de session 

    private $maxAge = -1;
    // durée de vie maximale d'une session-1 => pas de limite 

    private function __construct() { 
        //$this->nom = $nom; 
    } 
    public static function getInstance() {
        if (!self::$instance) 
            self::$instance = new self(); 
            return self::$instance; 
    } 
    public function start() { 
  
        session_start(); 
        if (isset($_SESSION['time'])) { 
            // dans ce cas la session est déjà active, donc on vérifie si elle doit se poursuivre 
            if ($this->maxAge !== -1 && time() - $_SESSION['time'] > $this->maxAge) {
                // la session est trop vielle ou trop usée, il faut la détruire 
                session_destroy(); 
                return false; 
            } 
           
        } 
        else { 
            // initialisation des variables contextuelles de la session 
			
            
            $_SESSION['time'] = time(); 
            $_SESSION['vars'] = ['status' => 0, 'login'=>""]; 
			
            // le tableau des variables de session return true; 
        } 
		return true;
    } 
    public function stop() { 
        if (isset($_SESSION['time'])) { 
            session_destroy(); 
        } 
        else { die("la session ne peut être détruite car elle n'est pas active !"); }
    } 


	
    // mutateur de maxAge 
    public function setMaxAge($num) {
        if (!is_numeric($num)) { 
            die(sprintf("la valeur <em>%s</em> n'est pas de type numérique !", htmlspecialchars($num))); 
        } 
        else { $this->maxAge = $num; } 
    } 
   


    // accesseur au temps de validité restant 
    public function getRemainingTime() { 
        return $_SESSION['time'] + $this->maxAge - time(); 
    } 
    // accesseur aux variables de session placées dans le tableau nommé "vars" 
    public function get($nom) { 
        if (isset($_SESSION['vars'][$nom])) { 
            return $_SESSION['vars'][$nom]; 
        } 
        else { 
        // dans le cas où la variable n'existe pas on retourne NULL pour éviter un "warning". 
        return NULL; } 
    } 
    // mutateur des variables de session placées dans le tableau nommé "vars" 
    public function set($nom, $val) { 
        $_SESSION['vars'][$nom] = $val; 
    } 
}