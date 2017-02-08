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

         $dbc = new ConnectDB(
                            'mysql',
                            'maemoon_com',
                            'localhost',
                            'root','');
    
         $this->result=$dbc->dbQuery($query);
        
    }

    function __toString(){
        $str = ""; 
        foreach ($this->result as $key => $value){
           
            foreach ($value as $k=>$v){
               if ($k=="chemin_relatif"){
                   switch($value['mime_type']){
                           case("image/jpeg"):
                           case("image/svg"):
                             case ('image/png'):
                            case ('image/gif'):
                            $str=$str."<img src='$v' class='vignette'/><br/>";
                           break;
                           case("audio/ogg"):
                           case("audio/mp3"): 
                            $str=$str."<audio controls> 
                           <source src='$v' type='".$value['mime_type']."' class='vignette'/></audio><br/>";
                           break;
                           case("video/webm"):
                           case("video/mp4"):
                            $str=$str."<video controls> 
                           <source src='$v' type='".$value['mime_type']."' class='vignette'/></video><br/>";
                           break;
                   }
        
            }else{
                $str=$str."$k : $v"."<br/>";    
               }
            }
           $str=$str."<br/>\n"; 
        }
       return $str;
    }
}