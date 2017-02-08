<?php
require_once('php/autoload.php');
//===================SESSION==========================
$s = Session::getInstance('session_non_auth'); 
$s->setMaxAge(10000); 

if ($s->start()) { 
 echo "session_id : ".session_id().'<br>';
} else {
    print("<p>Session terminée.</p>\n"); 
}
?>
    <!DOCTYPE html>

    <head>
        <meta charset='utf-8' />
        <link href="css/default.css" rel="stylesheet" />
        <title>Recherche de fichiers</title>
    </head>

    <body>
        <header>
            <h1>Projet PHP Objet</h1>
        </header>
        <div class="form">
            <h2>Rechercher un fichier</h2>
            <?php
            $form = new FormRecherche();
            echo $form;
			$rech = new FormResultat();
			echo $rech;
        ?>
        </div>
    </body>
