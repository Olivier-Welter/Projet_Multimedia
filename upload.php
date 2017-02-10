<?php

require_once('php/autoload.php');
$s = Session::getInstance('session_non_auth');
$s->setMaxAge(10000); 
$s->start();
//Création des variables pour afficher les données correctement.
$form_Auth = new FormAuth();
$form_up = new FormUpload();
$query = "SELECT * FROM datas WHERE auteur_id = '".$s->get('login')."' ORDER BY date DESC LIMIT 5";
$form_Resul = new FormResultat($query);
//redirection vers la page d'index si on n'est pas connecté
$a = Authentification::getInstance();
if(!$a->isAuth()){
	header("Location: index.php",TRUE,302);
    exit;
}

//Affichage des champs HTML
echo <<< EOT
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Charger - Bibliothèque multimédia</title>
		<link rel="stylesheet" href="./css/default.css" title = "default">
        <link rel="alternate stylesheet" href="./css/alternate.css" title="alternate">
		<script type="text/javascript" src="js/affichage.js"></script>
	</head>
	<body>

EOT;
echo '<header>'."\n";
echo "<h1><a href='index.php'>PROJET PHP Objet - Bibliothèque Multim&eacute;dia</a></h1>"."\n";
echo $form_Auth;
echo '</header>'."\n";

echo '<div class = "Rech form">'."\n";
echo $form_up;
echo $form_up->getMsg();
echo '</div>'."\n";

echo '<div class = "Resul">'."\n";
echo $form_Resul;
echo '</div>'."\n";

echo <<< EOF
    </body>
</html>
EOF;
