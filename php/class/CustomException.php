<?php

class CustomException extends Exception
{
      public function __construct($code, $msg, $file, $line) {
    $this->code = $code;
    $this->file = $file;
    $this->line = $line;
    $this->smsg = $msg;
    $res  = "<p>Erreur :</p><ul>\n";
    $res .= "<li>code : $code,</li>\n";
    $res .= "<li>message : $msg,</li>\n";
    $res .= "<li>fichier : $file,</li>\n";
    $res .= "<li>ligne : $line</li>\n</ul>\n";
    parent:: __construct($res);
  }
 
  // Méthode retournant un message d'erreur complet et formaté.
  public function getSystemMessage() {
    // On retourne un message d'erreur complet pour nos besoins.
    $return  = 'Une exception a été gérée :<br/>';
    $return .= sprintf('<strong>Erreur code <em>%d</em> Message : <em>%s</em></strong><br/>',
		       $this->code, $this->smsg);
    $return .= 'A la ligne : '.$this->line.'<br/>';
    $return .= 'Dans le fichier : '.$this->file.'<br/>';
    return $return;
  }
}