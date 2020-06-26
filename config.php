<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'holo269_licenta');
define('DB_PASSWORD', 'WeVideoPeViata');
define('DB_NAME', 'holo269_licenta');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>