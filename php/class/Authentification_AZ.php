<?php
class Authentification {
 
  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;
 
   /**
    * Constructeur de la classe
    *
    * @param void
    * @return void
    */
   private function __construct() {  
   }
 
   /**
    * Méthode qui crée l'unique instance de la classe
    * si elle n'existe pas encore puis la retourne.
    *
    * @param void
    * @return Singleton
    */
   public static function getInstance() {
 
     if(is_null(self::$_instance)) {
       self::$_instance = new Singleton();  
     }
 
     return self::$_instance;
   }
}
/*class Authentification 
{
    private $session;
    
    function __construct($session){
        $this->session = $session;
    }
    
    function isAuth(){
        if(isset($session)){
            return true;
        } else {
            return false;
        }
    }
    
    function checkUser($login,$passwd){
        
    }
    
    function disconnect(){
        
    }
}*/

/*class Auth{

    private $session; // variable de la session

    public function __construct($session){
        $this->session = $session;
    }

    public function connect($user){
        $this->session->write('auth', $user);
    }

    public function login($db, $login, $passwd){
        $user = $db->query('SELECT * FROM users WHERE (username = :username) AND confirmed_at IS NOT NULL', ['username' => $username])->fetch();
        if(password_verify($password, $user->password)){
            $this->connect($user);
            return $user;
        }else{
            return false;
        }
    }

    public function restrict(){
        if(!$this->session->read('auth')){
            $this->session->setFlash('danger', "Vous n'avez pas le droit d'accéder à cette page");
            header('Location: login.php');
            exit();
        }
    }
}
*/