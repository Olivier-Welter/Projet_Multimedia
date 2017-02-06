<?php 
class Session { 
    private static $instance; 
    private $nom = 'DEF_SESSID'; 
    // le nom de la variable de session 
    private $maxHops = -1; 
    // nombre maximal d'accés à la session, -1 => pas de limite 
    private $maxAge = -1;
    // durée de vie maximale d'une session-1 => pas de limite 
    private function __construct($nom) { 
        $this->nom = $nom; 
    } 
    public static function getInstance($nom) {
        if (!self::$instance) 
            self::$instance = new self($nom); 
            return self::$instance; 
    } 
    public function start() { 
        session_name($this->nom); 
        session_start(); 
        if (isset($_SESSION['time']) && isset($_SESSION['remainHops'])) { 
            // dans ce cas la session est déjà active, donc on vérifie si elle doit se poursuivre 
            if (($this->maxAge !== -1 && time() - $_SESSION['time'] > $this->maxAge) || ($this->maxHops !== -1 && $_SESSION['remainHops'] <= 0)) {
                // la session est trop vielle ou trop usée, il faut la détruire 
                session_destroy(); 
                return false; 
            } 
            else { $_SESSION['remainHops']--; return true; } 
        } 
        else { 
            // initialisation des variables contextuelles de la session 
            $_SESSION['remainHops'] = $this->maxHops; 
            $_SESSION['time'] = time(); 
            $_SESSION['vars'] = []; 
            // le tableau des variables de session return true; 
        } 
    } 
    public function stop() { 
        if (isset($_SESSION['time']) && isset($_SESSION['remainHops'])) { 
            session_destroy(); 
        } 
        else { die("la session ne peut être détruite car elle n'est pas active !"); }
    } 
    // mutateur de maxHops 
    public function setMaxHops($num) { 
        if (!is_numeric($num)) { 
            die(sprintf("la valeur <em>%s</em> n'est pas de type numérique !", htmlspecialchars($num)));
        } 
        else { $this->maxHops = $num; } 
    } 
    // mutateur de maxAge 
    public function setMaxAge($num) {
        if (!is_numeric($num)) { 
            die(sprintf("la valeur <em>%s</em> n'est pas de type numérique !", htmlspecialchars($num))); 
        } 
        else { $this->maxAge = $num; } 
    } 
    // accesseur au nombre de passages restants 
    public function getRemainingHops() { 
        return $_SESSION['remainHops']; 
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