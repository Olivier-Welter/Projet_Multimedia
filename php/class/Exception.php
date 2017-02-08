<?php
class Exception {
   // le code et le message sont définis par l'utilisateur
  protected $message = 'unknown'; // message exception
  protected $code = 0;            // code exception

  protected $file;    // fichier de l'exception
  protected $line;    // ligne de l'exception
  function __construct(string $message=NULL,
                       int code=0);
  final function getMessage();  // message
  final function getPrevious(); // exception précédente
  final function getCode();     // code
  final function getFile();     // fichier
  final function getLine();     // ligne
  final function getTrace();    // le tableau
  final function getTraceAsString();
  function _toString(); // pour l'affichage
}
?>