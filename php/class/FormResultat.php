<?php 

class FormResultat {
    
    private $query;
    private $res;
    
    /**
    * on informe les inputs dans la recherche 
    quand on click sur valider
    il affiche le résultat de la recherche en fonction de sa date 
    de la plus récente à la moins récente avec la vignette, 
    la description et l'élément recherché 
    **/
    function __construct ($query,$res){
        $this->query=$query;
        $this->res=$res;
        
    }
    
    function afficherResult(){
        $query="SELECT auteur_id,description,date FROM datas WHERE date";
        return   $this->res;
    }
    
}