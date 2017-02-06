<?php

class LogFile
{
    public static function toLog($array, $filename='./appli.log')
    {

        if($fileStream = fopen($filname))
        {
            foreach($array as $key => $val)
            {
                fwrite($filestream, date('d/m/Y - H:i:s').' : '.$val);
            } 
        }
        else
        {
            echo '<p class="error">Erreur impossible d\'enregistrer les information dans le fichier de log</p>';    
        }
    }
}