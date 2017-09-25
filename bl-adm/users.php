<?php session_start();
include ("../inc/database.php");
include ("../inc/config.php");
include("../inc/session_manager.class.php");

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
				<?php 
				if (isset($_GET['desc']) == 'all') {
                ?>
				<a href="adm-logs.php" style="float:left">Back to normal</a>
				<?php
				} else {
				?>
				<a href="?desc=all" style="float:left">See All Users</a>
				<?php 
				}
				?>
                            <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>City</th>
                                    <th>Phone</th>
									<th>Role</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
								<?php
								if (isset($_GET['desc']) == 'all') {
									$desc = '99999999';
								} else {
									$desc = '5';
								}
								if(isset($_GET['dell']) == 'all') {
									$del = $mysqli->query("DELETE FROM stanblog_admin_log");
									if ($del){
									echo '<script>window.location.href="adm-logs.php"</script>';
									}
								}
								$adm_logs = $mysqli->query("SELECT * FROM stanblog_users ORDER BY role ASC LIMIT 0,$desc");
								while($row = $adm_logs->fetch_assoc()) {
								?>
								 <tr>
                                    <td><?php echo $row['user']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['role']; ?></td>
									<td><button class='btn btn-danger fa fa-times' onclick="window.location.href='?rem=<?php echo $row['user'];?>'"> Remove</button> <?php if ($row['role']=='admin') {
										?> 
										 | <button class='btn btn-success fa fa-user' onclick='window.location.href="?role=user&crole=<?php echo $row['user'];?>"'> Make User</button>
									<?php
									} else {
									?>
									|  <button class='btn btn-warning fa fa-cog' onclick='window.location.href="?role=admin&crole=<?php echo $row['user'];?>"'> Make Admin</button>
									<?php
									}
									?></td>
									</tr>
								<?php
								}
								if (isset($_GET['rem'])) {
									$rem = $mysqli->real_escape_string($_GET['rem']);
									
									$remover = $mysqli->query("DELETE FROM stanblog_users WHERE user='$rem'");
									if(!isset($_GET['rem']) == '~') {
									if ($remover) {
										echo "<script>alert('Are you sure?')</script>";
										echo "<script>window.location.href='users.php'</script>";
									}
									} else {
										exit();
									}
								}
                                if (isset($_GET['role']) == 'user' || isset($_GET['role']) == 'admin') {
									$role = $mysqli->real_escape_string($_GET['role']);
									$crole = $mysqli->real_escape_string($_GET['crole']);
									$updater = $mysqli->query("UPDATE stanblog_users SET role='$role' WHERE user='$crole'");
									if($updater) {
									echo "<script>alert('Are you sure?')</script>";
									echo "<script>window.location.href='users.php'</script>";
									}
								}
								?>
                                
                            </tbody>
                        </table>
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