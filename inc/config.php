<?php
include ("database.php");

$sql = $mysqli->query("SELECT * FROM stanblog_titles");
$title = mysqli_fetch_row($sql);
$main_title = $title['0'];
$blog_title = $title['1'];
$blog_name = $title['2'];
