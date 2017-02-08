<?php

require_once('php/autoload.php');
$s = Session::getInstance('session_non_auth');
$s->setMaxAge(10000); 
$s->start();

$form_Auth = new FormAuth();
$form_Rech = new FormRecherche();
$form_Resul = new FormResultat($form_Rech->search());

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
