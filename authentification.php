<?php

require_once('php/autoload.php');
$s = Session::getInstance('session_non_auth');
$s->setMaxAge(10000); 
$s->start();

echo <<< EOT
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Connexion - Bibliothèque multimédia</title>
		<link rel="stylesheet" href="./css/default.css">
	</head>
	<body>

EOT;
echo '<header>'."\n";
echo '</header>'."\n";

echo <<< EOF
    </body>
</html>
EOF;