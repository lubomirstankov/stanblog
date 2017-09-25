<?php
$host = "localhost";
$name = "root";
$password = "";
$dbselect = "stanblog";
$port = "3306";
$mysqli = new mysqli($host,$name,$password,$dbselect,$port);
$mysqli->set_charset('utf8');
if($mysqli->connect_errno) {die('DataBase Server have problem please check your data');} 