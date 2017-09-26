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
if (isset($_GET['edit']) == 'mt') {
	if($_GET['edit'] == 'mt') {
?>
<form method="POST" action="">
<label for="maint">New Title Name</lable>
<input type='text' class='form-control' name='maint'>
<br />
<input type='submit' class='btn btn-primary' name='submit-mt' value='Change'>
<br />
</form>
<?php echo $msg;?>
<?php echo $err;?>
<br />
<hr />
<?php
}
}
?>
<?php 
if (isset($_GET['edit'])) {
	if($_GET['edit'] == 'bt') {
?>
<form method="POST" action="">
<label for="maint">New Blog Title Name</lable>
<input type='text' class='form-control' name='bt'>
<br />
<input type='submit' class='btn btn-primary' name='submit-bt' value='Change'>
<br />
</form>
<?php echo $msg;?>
<?php echo $err;?>
<br />
<hr />
<?php
}
} 
?>
<?php 
if (isset($_GET['edit'])) {
	if($_GET['edit'] == 'bn') {
?>
<form method="POST" action="">
<label for="maint">New Blog Name</lable>
<input type='text' class='form-control' name='bn'>
<br />
<input type='submit' class='btn btn-primary' name='submit-bn' value='Change'>
<br />
</form>
<?php echo $msg;?>
<?php echo $err;?>
<br />
<hr />
<?php
}
} 
?>
                       <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><center>Main Title</center></th>
                                        <th><center>Blog Title</center></th>
                                        <th><center>Blog Name</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                    <tr class="success">
<?php 
$title_q = $mysqli->query("SELECT * FROM stanblog_titles");
$title = mysqli_fetch_row($title_q);
?>
                                        <td><?php echo $title['0']; ?> <label class='fa fa-pencil btn btn-primary'onclick="window.location.href='?edit=mt'"></td>
                                        <td><?php echo $title['1']; ?> <label class='fa fa-pencil btn btn-primary'onclick="window.location.href='?edit=bt'"></td>
                                        <td><?php echo $title['2']; ?> <label class='fa fa-pencil btn btn-primary'onclick="window.location.href='?edit=bn'"></td>

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