<?php
//==================================Code de calcul des données de la page
require_once('php/autoload.php');
$s = Session::getInstance();
$s->setMaxAge(10000); 
$s->start();


$form_Auth = new FormAuth();


$form_Rech = new FormRecherche();
$form_Resul = new FormResultat($form_Rech->search());







//============================Code d'affichage de la page'
echo <<< EOT
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Bibliothèque multim&eacute;dia</title>
		<link rel="stylesheet" href="./css/default.css">
	</head>
	<body>

EOT;
echo '<header>'."\n";

echo '<p>PROJET PHP Objet - Bibliothèque Multim&eacute;dia</p>'."\n";

echo $form_Auth;

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
//==================================================	

echo '</header>'."\n";

echo '<div>'."\n";
echo $form_Rech;
echo '</div>'."\n";

echo '<div>'."\n";
echo $form_Resul;
echo '</div>'."\n";

echo <<< EOF
    </body>
</html>
EOF;
