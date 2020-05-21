<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'tema_3';

$connect = new mysqli($servername, $username, $password, $database);
if($connect->connect_error):
    die("Va rugam contactati administratorul site-ului<br>") . $connect->connect_error;
endif;