<?php
class FormRecherche extends BaseForm {
    public function __construct(){
        $this->formAttr = ['action'=>'#', 'method'=>'post', 'name'=>'searchform'];
        $this->addElem('input', ['name' => "auteur", 'type' => 'text', 'placeholder'=>'auteur'], 'Auteur : ');
        $this->addElem('input', ['name' => "descr", 'type' => 'text', 'placeholder'=>'description'], 'Description : ');
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
        }
    }

    /*public function __toString(){ $str = ''; foreach($this->champsAttr as $key => $val){ $in = new HTMLBalises($this->champsType[$key], $val, 'test'); if($this->champsLabel[$key] !== ''){ $elem = new HTMLBalises('label', [], $this->champsLabel[$key].$in); $str.=' '.$elem; }else{ $str.=' '.$in; } $str.=' '.new HTMLBalises('br'); } $form = new HTMLBalises('form', ['action'=>'#', 'method'=>'post', 'name'=>'searchform'], $str); return "$form"; }*/


    public function search(){
        $query = "SELECT auteur_id,description,date FROM datas WHERE date LIMIT 5";
        if(isset($this->champsAttr[0]['value'])){
            $query = "SELECT * from datas";
            if($this->champsAttr[0]['value']!=''){
                $query .= " WHERE auteur_id = '".$this->champsAttr[0]['value']."'";
                if($this->champsAttr[1]['value']!=''){
                    $query.=" AND description LIKE '%".$this->champsAttr[1]['value']."%'";
                }
            }else{
                if($this->champsAttr[1]['value']!=''){
                    $query.=" WHERE description LIKE '%".$this->champsAttr[1]['value']."%'";
                }
            }
        }
        echo $query;
        return ($query);
    }

    public function verif(){
        return true;
    }
}
