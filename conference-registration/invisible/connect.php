<?php
$connection = new PDO('pgsql:host = localhost;dbname = ConferencesDB','postgres','mypostgresbd');
if(!$connection){
    die('Error connect to DataBase!');
}
