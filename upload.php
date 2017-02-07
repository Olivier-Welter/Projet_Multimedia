<!DOCTYPE html>
<?php
require_once('php/autoload.php');
//===================SESSION==========================
$s = Session::getInstance('session_non_auth'); 
$s->setMaxAge(10000); 

if ($s->start()) { 
 echo "session_id : ".session_id().'<br>';

} 
else { 
    print("<p>Session terminée.</p>\n"); 
    }



$form = new FormUpload();
echo $form;
