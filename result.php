<?php

$dbh=new PDO("mysql:host=localhost;dbname=maemoon_com", "root", "");
/* Vérification de la connexion */

$res = $dbh->query("SELECT auteur_id,description,date 
FROM datas
WHERE date");
if ($res != false){ 
        while($row = $res->fetch()){
            echo $row['auteur_id'].' '.$row['description'].' '.$row['date']."<br/>";
        }
} else{
        echo "c'est faux";
}

/* Fermeture de la connexion */
unset($dbh);