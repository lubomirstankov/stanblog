<?php session_start();
include ("../inc/database.php");
include ("../inc/config.php");
include("../inc/session_manager.class.php");
$msg = "";

$ses = new session_manager();

if($ses->check_session()===false) {
	die("You have no permission to that page :)");
} else {
	// Get Browser Function 
require_once("browser.func.php");
    // END
	
	
$ip = $_SERVER['REMOTE_ADDR'];
$session_name = $ses->get_session_name();
$date = $mysqli->real_escape_string(date('d')."/".date('m')."/".date('Y'));
$hour = $mysqli->real_escape_string(date('h:i:sa'));
$page = $mysqli->real_escape_string($_SERVER['PHP_SELF']);
$mysqli->query("INSERT INTO stanblog_admin_log (page,ip_addr,user,date,time,browser) VALUES ('$page','$ip', '$session_name', '$date','$hour','$browser')");
}
$role_color = $mysqli->query("SELECT * FROM stanblog_users WHERE user='$session_name' AND role='admin'");
$num = mysqli_num_rows($role_color);
if ($num == 1) {

} else if ($num != 1){
die("You have no permission to that page :)");
}
if (isset($_POST['submit'])) {
	$pname = $mysqli->real_escape_string($_POST['pname']);
	$plink = $mysqli->real_escape_string($_POST['plink']);
	

	$creator = $mysqli->query("INSERT INTO stanblog_pages (page_name,page_link,visible) VALUES ('$pname','$plink','1')");
if($creator) {
	 $msg = '<h4><div class="alert alert-success"> <center> The page is created!!! </h4></div></center>';
} else {
	$msg = '<h4><div class="alert alert-danger"> <center> The page is not created!!! </h4></div></center>';
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $main_title; ?></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
  
<script src="https://use.fontawesome.com/783d16b3ff.js"></script>

        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                </div>
              
            </div>
        </div>
<?php include ("../assets/adm/topnav.php"); ?>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h2>ADMIN DASHBOARD</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>Welcome <?php echo $ses->get_session_name();?> ! </strong> Today is <?php echo date('d'); ?>/<?php echo date('m'); ?>/<?php echo date('Y'); ?>. Have a nice day!
                        </div>
                       
                    </div>
                    </div>
                  <!-- /. ROW  --> 
                            <div class="row text-center pad-top">


              </div>
                 <!-- /. ROW  --> 
                <div class="row text-center pad-top">
				<div class="col-lg-12 col-md-6">
<form method="POST" action="">
<input type="text" class="form-control" name="pname" placeholder="Page Name" required autofocus="" />
<br />
<input type="text" class="form-control" name="plink" placeholder="Page Link, Example: http://google.com" required autofocus="" />
<br />
<button type='submit' class='btn btn-primary' name='submit'>Create</button>
</form>
<?php echo $msg; ?>
              </div>   
			  </div>
                  <!-- /. ROW  -->    
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
