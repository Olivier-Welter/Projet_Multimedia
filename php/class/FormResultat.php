<?php 

/*class FormResultat {
    
    private $query;
    
    /**
    * on informe les inputs dans la recherche 
    quand on click sur valider
    il affiche le résultat de la recherche en fonction de sa date 
    de la plus récente à la moins récente avec la vignette, 
    la description et l'élément recherché 
    *
    function __construct ($query,$res){
        $this->query=$query;
        if (isset($POST['auteur']) || (isset($POST['descr']) ||(isset($POST['type[]']) ){
            afficherResult();
        } else {
            affichePremFois();
        }
       // $this->addElem('div',['name'=>'auteur_id', 'name'=>'description','name'=>'date']);
    }
    
    function afficherPremFois(){ // affichage des derniers rajouts quand l'utilisateur est là pour la première fois
         $query=mysql_query("SELECT auteur_id,description,date FROM datas WHERE date LIMIT 5");
    }
    
    
    function afficherResult(){ // affichage des résultats demandés
        $query="SELECT auteur_id,description,date FROM datas WHERE date";
       echo $query;
    }
    
}*/

class FormResultat
{
   public function fonctiontest()
   {
      $res=array();
      $query=mysql_query("SELECT auteur_id,description,date FROM datas WHERE date");
      while($reponse=mysql_fetch_array($query)){
          $res[]=$reponse;
      }
      return $res;
   }
}
?>