<?php 
require_once('./php/autoload.php'); 
$s = Session::getInstance('MA_SESSION'); 
$s->setMaxHops(10); 
$s->setMaxAge(50); 
if ($s->start()) { 
    $grainDeSel = rand();
    $newval = md5(rand().$grainDeSel); 
    // la variable aléatoire qui sera stockée en session 
    printf("<h2>Il reste <em>%s</em> accès.</h2>\n", $s->getRemainingHops());
    printf("<h2>Il reste <em>%s</em> secondes.</h2>\n", $s->getRemainingTime()); 
    printf("<p>voici la variable <var>test</var> précédémment enregistrée en session : <em>%s</em>.</p>\n", $s->get('test')); 
    printf("<p>voici la nouvelle valeur que je lui donne : <em>%s</em>.</p>\n", $newval); 
    $s->set('test', $newval); 
    // stockage de la variable "test" en session 
} 
else { 
    print("<p>Session terminée.</p>\n"); 
    }