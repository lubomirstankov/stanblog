<?php session_start();
include ("../inc/database.php");
include ("../inc/config.php");
include("../inc/session_manager.class.php");
$msg = "";
$err = "";

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
if (!empty($_POST['postTitle']) && !empty($_POST['postDesc'])) {
	
	$post_title = $mysqli->real_escape_string($_POST['postTitle']);
	$post_desc = $mysqli->real_escape_string($_POST['postDesc']);
	$id = $mysqli->real_escape_string($_GET['post']);
	
	$inserter = $mysqli->query("UPDATE stanblog_posts SET postTitle='$post_title', postCont = '$post_desc' WHERE postID = '$id'");
	if ($inserter) {
		$msg = '<h4><div class="alert alert-success"> <center> You successfull change post!! </h4></div></center>';
	} else {
		$err = '<h4><div class="alert alert-danger"> <center> Some problem with insert a post!!! </h4></div></center> <br />'.$mysqli->errno;
	}
	
} else {
	$err = '<h4><div class="alert alert-danger"> <center> Please enter a title or text!! </h4></div></center>';
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

    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>

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
if(isset($_GET['post'])) {
	$id = $mysqli->real_escape_string($_GET['post']);
} else if (empty($_GET['post'])) {
 $id = '';
} 
$cpost = $mysqli->query("SELECT * FROM stanblog_posts WHERE postID='$id'");
while($row = $cpost->fetch_assoc()) {
?>
<center>
	<form action='' method='post'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTitle']; ?>'></p>

		<p><label>Post</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postCont']; ?></textarea></p>


		<p><input type='submit' name='submit' value='Submit'></p>

	</form>
	<?php echo $msg;?>
	<?php echo $err;?>
	</center>
<?php 
}
?>
                       <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><center>#</center></th>
                                        <th><center>Post Title</center></th>
                                        <th><center>Action</center></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php 
$selectpost = $mysqli->query("SELECT * FROM stanblog_posts ORDER BY postDate ASC");
while($row = $selectpost->fetch_assoc()) {
?>                        <tr class="success">
                                        <td><?php echo $row['postID']; ?></td>
                                        <td><?php echo $row['postTitle']; ?></td>
                                        <td><button class='btn btn-success' onclick='window.location.href="edit-post.php?post=<?php echo $row['postID']; ?>"'>Edit</button></td>
<?php
}
?>
                                    </tr>                 
                                </tbody>
                            </table>
                        </div>
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