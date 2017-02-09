<?php 

class FormResultat {
    
    private $query;
    private $result;
    /**
    * on informe les inputs dans la recherche 
    quand on click sur valider
    il affiche le résultat de la recherche en fonction de sa date 
    de la plus récente à la moins récente avec la vignette, 
    la description et l'élément recherché 
    **/
    function __construct ($query){
         $this->result=ConnectDB::dbQRY($query);
    }
    
    /*function afficherPremFois(){ // affichage des derniers rajouts quand l'utilisateur est là pour la première fois
         $query=mysql_query("SELECT auteur_id,description,date FROM datas WHERE date LIMIT 5");
    }
    
    
    function afficherResult(){ // affichage des résultats demandés
        $query="SELECT auteur_id,description,date FROM datas WHERE date";
       echo $query;
    }*/
    function __toString(){
        $str = ""; 
        if(count($this->result)>0){
             foreach ($this->result as $key => $value){
           
            foreach ($value as $k=>$v){
               if ($k=="chemin_relatif"){
                   switch($value['mime_type']){
                           case("image/jpeg"):
                           case("image/svg"):
                             case ('image/png'):
                            case ('image/gif'):
                            $str=$str."<img src='multimedia/img/$v' class='vignette'/>";
                           break;
                           case("audio/ogg"):
                           case("audio/mp3"): 
                            $str=$str."<audio controls> 
                           <source src='multimedia/audio/$v' type='".$value['mime_type']."' class='vignette'/></audio>";
                           break;
                           case("video/webm"):
                           case("video/mp4"):
                            $str=$str."<video controls> 
                           <source src='multimedia/video/$v' type='".$value['mime_type']."' class='vignette'/></video>";
                           break;
                   }
        
            }else{
                $str=$str."$k : $v"."<br/>";    
               }
            }
           $str=$str."<br/>\n"; 
        }
        }else{
            $str ="Aucun résultat";
        }
       
       return $str;
    }
}
