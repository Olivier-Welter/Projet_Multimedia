<?php

class CustomException extends Exception
{
    public function getError() {
    $r = 'Une exception a été gérée :<br/>';
    $r .= 'Message : '.$this->getMessage().'<br/>';
    $r .= 'À la ligne : '.$this->getLine().'<br/>';
    $r .= 'Dans : '.$this->getFile().'<br/>';
    return $r;
    }
}