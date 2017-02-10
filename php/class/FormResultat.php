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
        if(count($this->result)==1){
            $str .= "<span class='visionne'>";
            $mime = substr($this->result[0]['mime_type'], 0, 5);
            $chemin = 'multimedia/'.$mime.'/'.$this->result[0]['chemin_relatif'];
            $descr = $this->result[0]['description'];
            switch($mime){
                case("image"):
                    $str=$str."<img src='$chemin' class='vignette' alt='$descr'/>\n";
                    break;
                case("audio"):
                    $str=$str."<audio controls class='vignette'>
                    <source src='$chemin' type='".$this->result[0]['mime_type']."'/></audio>\n";
                    break;
                case("video"):
                    $str=$str."<video controls class='vignette'>
                    <source src='$chemin' type='".$this->result[0]['mime_type']."'/></video>\n";
                    break;
            }
            $str.="Auteur : ".$this->result[0]['auteur_id']."<br/>\n";
            $str.="Description : ".$this->result[0]['description']."<br/>\n";
            $str.="Date ajout : ".$this->result[0]['date']."<br/>\n";
            $str.="</span>\n";
        } elseif(count($this->result)>1){
            foreach ($this->result as $key => $value){
                $str .= "<span class='resume'>";
                //if($value['mime_type']=='video/ogg'){ //pour le problème des ogg qui passent en tant que vidéo, voir si on trouve une meilleure solution
                //    $mime = 'audio';
                //}else{
                    $mime = substr($value['mime_type'], 0, 5);
                //}
                $chemin = 'multimedia/'.$mime.'/'.$value['chemin_relatif'];
                $descr = $value['description'];
                switch($mime){
                    case("image"):
                        $str=$str."<img src='$chemin' class='vignette' alt='$descr'/>\n";
                        break;
                    case("audio"):
                        $str=$str."<audio controls class='vignette'>
                        <source src='$chemin' type='".$value['mime_type']."'/></audio>\n";
                        break;
                    case("video"):
                        $str=$str."<video controls class='vignette'>
                        <source src='$chemin' type='".$value['mime_type']."'/></video>\n";
                        break;
                }
                $str.="Auteur : ".$value['auteur_id']."<br/>\n";
                $str.="Description : $descr<br/>\n";
                $str.="Date ajout : ".$value['date']."<br/>\n";
                $str.="</span>\n";
            }
        }else{
            $str ="Aucun résultat";
        }
       return $str;
    }
}

    /*function __toString(){
        $str = "";
        if(count($this->result)>0){
             foreach ($this->result as $key => $value){
           
            foreach ($value as $k=>$v){
               if ($k=="chemin_relatif"){
                   $mime = substr($value['mime_type'], 0, 5);
                   switch($mime){
                           case("image"):
                           $str=$str."<img src='multimedia/img/$v' class='vignette'/>";
                           break;
                           case("audio"):
                           $str=$str."<audio controls>
                           <source src='multimedia/audio/$v' type='".$value['mime_type']."' class='vignette'/></audio>";
                           break;
                           case("video"):
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
    }*/
