<?php 
function get_user_browser(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];        $ub = '';
    if(preg_match('/MSIE/i',$u_agent)) {   
	$ub = "Internet Explorer";     
}
    elseif(preg_match('/Firefox/i',$u_agent)){  
	$ub = "Mozila FireFox";    
}
    elseif(preg_match('/Safari/i',$u_agent))    {   $ub = "Safari"; }
    elseif(preg_match('/Chrome/i',$u_agent))    {   $ub = "Google Chrome"; }
    elseif(preg_match('/Flock/i',$u_agent)) {   $ub = "Flock";      }
    elseif(preg_match('/Opera/i',$u_agent)) {   $ub = "Opera";      } else { $ub="Undefined"; }
	return $ub;
}
$browser = get_user_browser();
?>