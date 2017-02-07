<?php 

//class FormResultat extends BaseForm{
    
   /* private $auteur;
    private $descr;
    private $type[];
    
    /**
    * on informe les inputs dans la recherche 
    quand on click sur valider
    il affiche le résultat de la recherche en fonction de sa date 
    de la plus récente à la moins récente avec la vignette, 
    la description et l'élément recherché 
    **
    function __construct ($auteur,$descr,$type[]){
        $this->auteur=$auteur;
        $this->descr=$descr;
        $this->type=$type[];
        
    }
    
    function afficherResult(){
        return  $this->auteur." ".$this->descr;
    }*/
    

//}


$mysqli=new PDO("mysql:host=localhost;dbmane=maemoon_com", "root", "");
/* Vérification de la connexion */
if (mysqli_connect_errno()) {
    printf("Échec de la connexion : %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT date,description,login FROM users,datas WHERE auteur_id.datas = users_id.users WHERE date DESC";

if ($result = $mysqli->query($query)) {

    /* Récupère un tableau associatif */
    while ($row = $result->fetch_assoc()) {
        echo $row["description"]." ".$row["login"]." ".$row["date"];
    }

    /* Libération des résultats */
    $result->free();
}

/* Fermeture de la connexion */
$mysqli= null;