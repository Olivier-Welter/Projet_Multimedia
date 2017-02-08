<?php

require_once('php/autoload.php');
$s = Session::getInstance('session_non_auth');
$s->setMaxAge(10000); 
$s->start();

//Création des variables pour afficher les données correctement.
$form_up = new FormUpload();

$s->set('login','toto');//juste pour le test, à virer quand il y aura la connexion

//Affichage des champs HTML
echo <<< EOT
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Charger - Bibliothèque multimédia</title>
		<link rel="stylesheet" href="./css/default.css">
	</head>
	<body>

EOT;
echo '<header>'."\n";

echo '</header>'."\n";

echo '<div class = "form">'."\n";
echo $form_up;
echo '</div>'."\n";

echo <<< EOF
    </body>
</html>
EOF;
