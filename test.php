<?php
require_once('./php/autoload.php');

// $dbc = new ConnectDB(
//         'mysql',
//         'maemoon_com',
//         'maemoon.com.mysql',
//         'maemoon_com',
//         'TotoIsNotTiti');
//$dbc->dbQuery('SELECT * FROM users');
$dbc = new ConnectDB(
        'mysql',
        'mediabdd',
        'localhost',
        'root',
        '');

$resultSet = $dbc->dbQuery('SELECT * FROM users');
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