<?php
class FormRecherche extends BaseForm {
    public function __construct(){
        $this->formAttr = ['action'=>'#', 'method'=>'post', 'name'=>'searchform'];
        $this->addElem('input', ['name' => "auteur", 'type' => 'text', 'placeholder'=>'auteur', 'maxlength'=>"20"], '<span>Auteur : </span>');
        $this->addElem('input', ['name' => "descr", 'type' => 'text', 'placeholder'=>'description', 'maxlength'=>"50"], '<span>Description : </span>');
        $this->addElem('input', ['name' => "type[]", 'type' => 'checkbox', 'value'=>'img'], 'Images');
        $this->addElem('input', ['name' => "type[]", 'type' => 'checkbox', 'value'=>'audio'], 'Audio');
        $this->addElem('input', ['name' => "type[]", 'type' => 'checkbox', 'value'=>'video'], 'Vidéo');
        $this->addElem('input', ['name' => "search", 'type' => 'submit', 'value'=>'Rechercher']);

        if(isset($_POST['search'])){
            //print_r($_POST);
            $this->champsAttr[0]['value'] = htmlspecialchars ($_POST['auteur']);
            $this->champsAttr[1]['value'] = htmlspecialchars ($_POST['descr']);
            if (isset($_POST['type'])){
                foreach($_POST['type'] as $val){
                if ($val == 'img') $this->champsAttr[2]['checked'] = 'checked';
                if ($val == 'audio') $this->champsAttr[3]['checked'] = 'checked';
                if ($val == 'video') $this->champsAttr[4]['checked'] = 'checked';
                }
            }
        }else{
            $this->champsAttr[2]['checked'] = 'checked';
            $this->champsAttr[3]['checked'] = 'checked';
            $this->champsAttr[4]['checked'] = 'checked';
        }
    }


    /*
    Pas de paramètres
    Retourne une chaine de caractères correspondant à la requête qui doit être envoyée à la base de données
    */
    public function search(){
        //si on a pas lancé de recherche on utilise la requête par défaut
        $query = "SELECT * FROM datas ORDER BY date DESC LIMIT 5";
        //si on a récupéré des valeurs on les utilise pour la recherche
        if(isset($this->champsAttr[0]['value'])){
            if ($this->check()){
                $query = "SELECT * from datas";
                //recherche de l'auteur et de la description
                $cond1 = '';
                if($this->champsAttr[0]['value']!=''){
                    $cond1 .= " WHERE auteur_id LIKE '%".$this->champsAttr[0]['value']."%'";
                    if($this->champsAttr[1]['value']!=''){
                        $cond1.=" AND description LIKE '%".$this->champsAttr[1]['value']."%'";
                    }
                }else{
                    if($this->champsAttr[1]['value']!=''){
                        $cond1.=" WHERE description LIKE '%".$this->champsAttr[1]['value']."%'";
                    }
                }
                //recherche en fonction du type de fichiers
                $cond2 = '';
                if (isset($this->champsAttr[2]['checked'])){
                    $cond2.="(mime_type LIKE 'image/%'";
                    if (isset($this->champsAttr[3]['checked'])){
                        $cond2.=" OR mime_type LIKE 'audio/%'";
                    }
                    if (isset($this->champsAttr[4]['checked'])){
                        $cond2.=" OR mime_type LIKE 'video/%'";
                    }
                    $cond2.=")";
                }else{
                    if (isset($this->champsAttr[3]['checked'])){
                        $cond2.="(mime_type LIKE 'audio/%'";
                        if (isset($this->champsAttr[4]['checked'])){
                            $cond2.=" OR mime_type LIKE 'video/%'";
                        }
                        $cond2.=")";
                    }else{
                        if (isset($this->champsAttr[4]['checked'])){
                            $cond2.="(mime_type LIKE 'video/%')";
                        }
                    }
                }
                //création de la requête à partir des deux conditions
                if(($cond1!='')&&($cond2!='')){$query .= $cond1." AND ".$cond2; }
                elseif(($cond1=='')&&($cond2!='')){$query .= " WHERE ".$cond2; }
                else{$query .= $cond1; }
            }
        }
        return ($query);
    }

    public function check(){
        if(strlen($_POST['descr'])>50){
            $this->champsAttr[1]['class'] = 'invalid';
            return false;
        }
        return true;
    }
}
