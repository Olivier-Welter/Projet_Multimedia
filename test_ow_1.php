<?php 
require_once('./php/autoload.php'); 
$s = Session::getInstance('session_non_auth'); 
$s->setMaxHops(1000); 
$s->setMaxAge(10000); 
if ($s->start()) { 
    $grainDeSel = rand();
    $newval = md5(rand().$grainDeSel); 
    // la variable aléatoire qui sera stockée en session 
    //printf("<h2>Il reste <em>%s</em> accès.</h2>\n", $s->getRemainingHops());
    //printf("<h2>Il reste <em>%s</em> secondes.</h2>\n", $s->getRemainingTime()); 
    //printf("<p>voici la variable <var>test</var> précédémment enregistrée en session : <em>%s</em>.</p>\n", $s->get('test')); 
    printf("<p>Session ID : <em>%s</em>.</p>\n", $newval); 
    $s->set('test', $newval); 
    // stockage de la variable "test" en session 
} 
else { 
    print("<p>Session terminée.</p>\n"); 
    }
//==================================================	
	$dbc = new ConnectDB(
        'mysql',
        'maemoon_com',
        'localhost',
        'root',
        '');
		
//==================================================		
$form = new FormAuth();
echo $form;
//==================================================	
$resultSet = $dbc->dbQuery('SELECT * FROM users where maemoon_com.users.login=');
echo '<pre>';
print_r($resultSet);
echo '</pre>';

if(isset($resultSet))
{
    echo '<table>';
    foreach($resultSet as $keyLine => $valLine)
    {
        echo '<tr>';
        foreach($valLine as $keyCol => $val)
        {
            echo '<td>';
            echo $val;
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
else
{
    echo '<p>Aucun résultat</p>';
}
//==================================================	