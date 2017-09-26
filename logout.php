<?php session_start();
// Session was started here
//
//
//   ---- Lubomir StankoV ---- 
// ▒█░░░ ░▀░ █▀▀▀ █░░█ ▀▀█▀▀ ▒█▀▀█ █░░ █▀▀█ █▀▀▀ 
// ▒█░░░ ▀█▀ █░▀█ █▀▀█ ░░█░░ ▒█▀▀▄ █░░ █░░█ █░▀█ 
// ▒█▄▄█ ▀▀▀ ▀▀▀▀ ▀░░▀ ░░▀░░ ▒█▄▄█ ▀▀▀ ▀▀▀▀ ▀▀▀▀ 
//
// Thx for using LightBlog 2017.. ;)
//
//
//
//
//
//
//
unset($_SESSION['logged']);
session_destroy();
header("Location: index.php");
