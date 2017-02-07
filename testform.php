<!DOCTYPE html>
<?php
require_once('php/autoload.php');
//===================SESSION==========================
$s = Session::getInstance('session_non_auth'); 
$s->setMaxHops(1000); 
$s->setMaxAge(10000); 
if ($s->start()) { 


} 
else { 
    print("<p>Session terminée.</p>\n"); 
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
	
$form = new FormRecherche();
echo $form;

$form = new FormUpload();
echo $form;
