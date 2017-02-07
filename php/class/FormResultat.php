<?php 

class FormResultat extends BaseForm{
    
    private $auteur;
    private $descr;
    private $type[];
    
    /**
    * on informe les inputs dans la recherche 
    quand on click sur valider
    il affiche le résultat de la recherche en fonction de sa date 
    de la plus récente à la moins récente avec la vignette, 
    la description et l'élément recherché 
    **/
    
    $mysql = new PDO("mysql:host=localhost", "maemon_com", "root", "");
    if (mysqli_connect_errno()) {
    printf("Échec de la connexion : %s\n", $mysql->connect_error);
    exit();
}

    $query = 'SELECT date,description,nom FROM users,datas WHERE auteur_id.datas = users_id.users WHERE date DESC';
    
    if ($result = $mysqli->query($query)) {

    /* Récupère un tableau associatif */
    while ($row = $result->fetch_assoc()) {
        echo $row["description"]." ".$row["nom"]." ".$row["date"];
    }

    /* Libération des résultats */
    $result->free();
}

/* Fermeture de la connexion */
$mysql->close();
}