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

<?php

$dbh=new PDO("mysql:host=localhost;dbname=maemoon_com", "root", "");
/* Vérification de la connexion */

$res = $dbh->query("SELECT * FROM datas");
if ($res != false){ 
while($row = $res->fetch() ){
    echo $row['auteur_id'].' '.$row['date']."<br/>";
}
} else{
    echo "c'est faux";
}

/* Fermeture de la connexion */
$dbh= null;