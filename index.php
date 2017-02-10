<?php
//==================================Code de calcul des données de la page
require_once('php/autoload.php');
$s = Session::getInstance();
$s->setMaxAge(10000); 
$s->start();
$a = Authentification::getInstance();
//echo "<h3>session_id : ".session_id().'</h3>';


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
		<link rel="alternate stylesheet" href="./css/default.css" title = "default">
		<link rel="alternate stylesheet" href="./css/test_claire_v2.css" title = "test2">
        <link rel="stylesheet" href="./css/test_claire.css" title="test">
	</head>
	<body>

EOT;
echo '<header>'."\n";
echo '<h1><a href="index.php">PROJET PHP Objet - Bibliothèque Multim&eacute;dia</a></h1>'."\n";
if($a->isAuth()){
	echo "<a href='upload.php'>Uploader un fichier</a>";
}
echo '<div class="Auth">';
echo $form_Auth;
echo '</div>';
echo '</header>'."\n";

echo '<div class="Rech form">'."\n";
echo $form_Rech;
echo '</div>'."\n";

echo '<div class="Resul">'."\n";
echo $form_Resul;
echo '</div>'."\n";

echo <<< EOF
    </body>
</html>
EOF;
