<?php session_start();
// Session Start
//▒█░░░ ░▀░ █▀▀▀ █░░█ ▀▀█▀▀ ▒█▀▀█ █░░ █▀▀█ █▀▀▀ 
//▒█░░░ ▀█▀ █░▀█ █▀▀█ ░░█░░ ▒█▀▀▄ █░░ █░░█ █░▀█ 
//▒█▄▄█ ▀▀▀ ▀▀▀▀ ▀░░▀ ░░▀░░ ▒█▄▄█ ▀▀▀ ▀▀▀▀ ▀▀▀▀ 
//
//　 　 　 　 　 　 　 　 　 　 　 ░█▀▀█ ▒█▀▀▄ ▒█▀▄▀█ ▀█▀ ▒█▄░▒█ 
//　 　 　 　 　 　 　 　 　 　 　 ▒█▄▄█ ▒█░▒█ ▒█▒█▒█ ▒█░ ▒█▒█▒█ 
//　 　 　 　 　 　 　 　 　 　 　 ▒█░▒█ ▒█▄▄▀ ▒█░░▒█ ▄█▄ ▒█░░▀█ 
//
//
//
// Includes
require ("../inc/database.php");
require ("../inc/config.php");
require ("../inc/session_manager.class.php");
//
//
// Message Varialbe (1.0 version);
$msg = "";
$err = "";
//
//
//
$ses = new session_manager();
//
//
//
// Session Perms
if($ses->check_session()===false) {
	die("You have no permission to that page :)");
}
	// Get Browser Function 
require_once("browser.func.php");
    // END
//	
//	
//	
// Log & Permission System
require "../assets/adm/log&perm.sys.php";
//
//
//
// Page HTMLs
include "../assets/adm/adm_edit-site.php";