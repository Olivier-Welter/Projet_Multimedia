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
echo <<< EOT
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Bibliothèque multimédia</title>
		<link rel="stylesheet" href="./css/default.css">
	</head>
EOT;
?>

    <body>
        <header>
            <h1>Projet PHP Objet</h1>
        </header>
		<div class="form">
			<?php
			
				$dbc = new ConnectDB(
				'mysql',
				'maemoon_com',
				'localhost',
				'root',
				'');
				
				$faut = new FormAuth();
				echo $faut;
				//==================================================	
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
			?>
		</div>		
        <div class="form">
            <h2>Déposer un fichier</h2>
            <?php
            $form = new FormUpload();
            echo $form;
        ?>
        </div>
    </body>
