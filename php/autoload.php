<?php
function __autoload($className)
{
    $suffixe = mb_substr($className, -4);
    $fileName = mb_substr($className, strlen($className)-4);

    switch ($suffixe)
    {
        case "_Int":
            require_once './php/interfaces/'.$className.'.php';
            break;
        case "_TrT":
            require_once './php/traits/'.$className.'.php';
            break;
        default:
            require_once './php/class/'.$className.'.php';
    }
}