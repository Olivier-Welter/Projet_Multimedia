<?php 
require_once('./php/autoload.php'); 
$s = Session::getInstance('session'); 
$s->setMaxHops(1000); 
$s->setMaxAge(10000); 



if ($s->start()) { 
 
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

if(!empty($resultSet))
{
    echo '<table>';
    foreach($resultSet as $keyLine => $valLine)
    {
        echo '<tr>';
        foreach($valLine as $keyCol => $val)
        {
            echo '<td>';
            echo $val;
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
else
{
    echo '<p>Aucun résultat</p>';
}
//==================================================	