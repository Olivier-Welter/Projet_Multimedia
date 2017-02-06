<?php
function __autoload($class_name) {
  $fname = $class_name.'.class.php';
  if (is_readable($fname)) require_once $fname;
}
?>