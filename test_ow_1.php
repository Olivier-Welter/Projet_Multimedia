<?php 
require_once('./php/autoload.php'); 
$s = Session::getInstance('session'); 
$s->setMaxAge(10000); 

if ($s->start()) { 
 echo "session_id : ".session_id().'<br>';
} 
else { 
    echo("<p>Session terminée.</p>\n"); 
    }
//==================================================	
	$dbc = new ConnectDB(
        'mysql',
        'maemoon_com',
        'localhost',
        'root',
        '');
	
		//$dbc->dbQuery('SELECT * FROM users');
// $dbc = new ConnectDB(
//         'mysql',
//         'mediabdd',
//         'localhost',
//         'root',
//         '');
//==================================================		
$form = new FormAuth();
echo $form;
//==================================================	
$resultSet = $dbc->dbQuery('SELECT * FROM users where login=\''.$_POST['login'].'\' and passwd = \''.$_POST['passwd'].'\'');

 if(count($resultSet)==1){
$s->set('login',$_POST['login']);
$s->set('status',1);
}
else{
$s->set('login','');
$s->set('status',0);	
}

print_r($resultSet);
var_dump($_SESSION);

