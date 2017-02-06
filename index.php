<?php
session_start();
?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Test des sessions</title>
 <style type="text/css">
   h1 {color:#700;}
   .destroy {color:#F00;background-color:#FF0;text-align:center;}
   cite {color:#FFF;background-color:#888;padding:0 1em;font-weight:bold;}
   label {display:block}
</style>
</head>
<body>
<h1>Test des sessions</h1>
<?php
 
if (isset($_SESSION['compteur'])){
  $_SESSION['compteur']++;
} else {
  $_SESSION['compteur'] = 1;
}
 
$id_de_session  = session_id();
$nom_de_session = session_name();
if (isset($_SESSION['temps'])){
  $diff_time = time() - $_SESSION['temps'];
 
  printf("<p>Temps écoulé depuis le dernier passage : <strong>%s</strong> secondes</p>", $diff_time);
  if ($diff_time > 30) {
    printf ("<h2>Durée de session (id = %s) dépassée !</h2>", $id_de_session);
    printf("<h3><a href=\"%s\">Recommencer une session</a></h3>",
           $_SERVER["SCRIPT_NAME"]);
    session_destroy();
    exit();
  }
  printf("<h3>passage numéro <em>%d</em> dans la session %s(%s)</h3>",
         $_SESSION['compteur'], $nom_de_session, $id_de_session);
  $_SESSION['temps']=time();
 } else {
  $_SESSION['temps'] = time();
  printf("<h3>vous entrez dans une nouvelle session %s = %s</h3>", $nom_de_session, $id_de_session);
}
 
if (isset($_POST['fin_session'])) {
  print ("<h2 class=\"destroy\">Session volontairement détruite !</h2>");
  printf("<h3><a href=\"%s\">Recommencer une session</a></h3>", $_SERVER["SCRIPT_NAME"]);
  session_destroy();
  exit();
}
 
print ('<form action="" method="post"><fieldset><legend>Envoi de valeurs</legend>');
foreach(['nom', 'prenom', 'age'] as $val) {
  if (isset($_POST[$val])) $_SESSION[$val] = $_POST[$val];
  elseif (!isset($_SESSION[$val])) $_SESSION[$val] = '';
  printf('<label>%s :<input type="text" name="%s" value="%s"/></label>',
         ucfirst($val),  $val, $_SESSION[$val]);
}
print('<p><input type="submit" value="envoyer" />');
print('<input type="submit" class="destroy" name="fin_session" value="terminer la session" /></p>');
print("</fieldset></form>");
