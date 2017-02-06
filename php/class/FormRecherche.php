<?php
class FormRecherche {
    private $champsType = ['input', 'input', 'input'];
    private $champsAttr =
        [['name' => "auteur", 'type' => 'text', 'placeholder' => "auteur"],
         ['name' => "descr", 'type' => 'text', 'placeholder' => "desc"],
         ['name' => 'search', 'type' => 'submit', 'value' => 'Rechercher']];
    private $champsLabel = ['Auteur : ', 'Description : ', ''];

    public function __construct(){
        if(isset($_POST['search'])){
            echo  $_POST['auteur'];
            $this->champsAtrr[0]['value'] = $_POST['auteur'];
            $this->champsAtrr[1]['value'] = $_POST['descr'];
        }
    }

    public function __toString(){
        $str = '';
        foreach($this->champsAttr as $key => $val){
            $in = new HTMLBalises($this->champsType[$key], $val, 'test');
            if($this->champsLabel[$key] !== ''){
                $elem = new HTMLBalises('label', [], $this->champsLabel[$key].$in);
                $str.=' '.$elem;
            }else{
                $str.=' '.$in;
            }
            $str.=' '.new HTMLBalises('br');
        }
        $form = new HTMLBalises('form', ['action'=>'#', 'method'=>'post', 'name'=>'searchform'], $str);
        return "$form";
    }

    public function verif(){
        return Validator::check_desc_search($champsAtrr[1]['value']);
    }
}
