<?php
class FormAuth extends BaseForm {

    public function __construct(){
        $this->formAttr = ['action'=>'#', 'method'=>'post', 'name'=>'authform'];
        $this->addElem('input', ['name' => "login", 'type' => 'text', 'placeholder'=>'login'], 'login : ');
        $this->addElem('input', ['name' => "passwd", 'type' => 'text', 'placeholder'=>'passwd'], 'passwd : ');

        $this->addElem('input', ['name' => "auth", 'type' => 'submit', 'value'=>'Authentification']);

        if(isset($_POST['auth'])){
           
            $this->champsAttr[0]['value'] = $_POST['login'];
            $this->champsAttr[1]['value'] = $_POST['passwd'];
		 
         
        }
    }

    /*public function __toString(){ $str = ''; foreach($this->champsAttr as $key => $val){ $in = new HTMLBalises($this->champsType[$key], $val, 'test'); if($this->champsLabel[$key] !== ''){ $elem = new HTMLBalises('label', [], $this->champsLabel[$key].$in); $str.=' '.$elem; }else{ $str.=' '.$in; } $str.=' '.new HTMLBalises('br'); } $form = new HTMLBalises('form', ['action'=>'#', 'method'=>'post', 'name'=>'searchform'], $str); return "$form"; }*/

    public function verif(){
        return Validator::check_desc_search($champsAtrr[1]['value']);
    }
}
