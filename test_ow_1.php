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




$resultSet = $dbc->dbQuery('SELECT * FROM users where login=\''.$_POST['login'].'\'');
echo '<pre>';
print_r($s);
print_r($resultSet);
echo '</pre>';
var_dump($_SESSION);



else
{
    echo '<p>Aucun résultat</p>';
}
//==================================================	