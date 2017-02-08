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
		 	$dbc = new ConnectDB(
				'mysql',
				'maemoon_com',
				'localhost',
				'root',
				'');
				
				$resultSet = $dbc->dbQuery('SELECT * FROM users where login=\''.$_POST['login'].'\' and passwd = \''.$_POST['passwd'].'\'');

				if(count($resultSet)==1){
				$s->set('login',$_POST['login']);
				$s->set('status',1);
				}
				else{
				$s->set('login','');
				$s->set('status',0);	
				}
         
        }
    }

    /*public function __toString(){ $str = ''; foreach($this->champsAttr as $key => $val){ $in = new HTMLBalises($this->champsType[$key], $val, 'test'); if($this->champsLabel[$key] !== ''){ $elem = new HTMLBalises('label', [], $this->champsLabel[$key].$in); $str.=' '.$elem; }else{ $str.=' '.$in; } $str.=' '.new HTMLBalises('br'); } $form = new HTMLBalises('form', ['action'=>'#', 'method'=>'post', 'name'=>'searchform'], $str); return "$form"; }*/

    public function verif(){
        return Validator::check_desc_search($champsAtrr[1]['value']);
    }
}



	