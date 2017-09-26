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
// Includes
require ("inc/database.php");
require ("inc/config.php");
require ("inc/session_manager.class.php");
// Includes
//
//
//
// Variables
$img = "";
$msg = "";
// Variables
//
//
//
//
// Session Manager
$ses = new session_manager();
// Session Manager
//
//
//
//Check session is valid
if($ses->check_session()===false) {
	$session_name = "";
	header("location:login.php");
}  else {
$session_name = $ses->get_session_name();
}
$role_color = $mysqli->query("SELECT * FROM stanblog_users WHERE user='$session_name' AND role='admin'");
$num = mysqli_num_rows($role_color);
if ($num == 1) {
$name_color = "red";
} else if ($num != 1){
$name_color= "blue";
}
//
//
//
//
//Page HTML 
include ("assets/adm/posts.php");
include ("assets/adm/usercp.php");
?>
