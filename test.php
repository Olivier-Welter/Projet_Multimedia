<?php
require_once('./php/autoload.php');

$dbc = new ConnectDB(
        'mysql',
        'maemoon_com',
        'maemoon.com.mysql',
        'maemoon_com',
        'TotoIsNotTiti');
//$dbc->dbQuery('SELECT * FROM users');