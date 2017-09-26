<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $main_title; ?></title>
<link href='http://fonts.googleapis.com/css?family=Nova+Mono' rel='stylesheet' type='text/css' />
<link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
<link href="assets/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<h1><a href="#"><?php echo $blog_title; ?> </a></h1>
				<p>Welcome to <a href="#" rel="nofollow"><?php echo $blog_name; ?></a></p>
			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="menu">
		<ul>
		<?php 
		$pages = $mysqli->query("SELECT * FROM stanblog_pages WHERE visible='1'");
		while($row = $pages->fetch_assoc()) {
        if (basename(__FILE__) == $row['page_link']) {
			$current = "current_page_item";
		} else {
			$current = "";
		}
		?>
			<li class="<?php echo $current; ?>"><a href="<?php echo $row['page_link']; ?>"><?php echo $row['page_name']; ?></a></li>
        <?php
        }
        ?>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
<?php 
if(isset($_GET['avatar'])) {
?>
<div class="panel panel-default">
  <div class="panel-heading">Change your avatar</div>
  <div class="panel-body"> 
<form action="" method="post" enctype="multipart/form-data">
    <center> Maximum image size: 1Mb ! </center> 
	<br />
    <center><input type="file" name="image"/></center>
	<br />
	
    <center><input type="submit" name="submit" value="Upload"/></center>
	<br />
	<?php echo $img; ?>
</form>
  </div>
</div>
<?php 
}
if (isset($_GET['newpass'])) {
?>
<div class="panel panel-default">
  <div class="panel-heading">Update Password</div>
  <div class="panel-body">
  <form method="POST" action="">
  <center><input type="text"  name="skey" placeholder="Your secret word!!" /></center>
  <br />
  <center><input type="password"  name="newpass" placeholder="Type your new password" required /></center>
  <br />
  <center><button type='submit' name='sub' class='btn btn-warning'>Change</button></center>
  </form>
  </div>
  <?php echo $msg;?>
</div>
<?php 
}
if (isset($_GET['details'])) {
?>
<div class="panel panel-default">
  <div class="panel-heading">Your Details</div>
  <div class="panel-body">
  <?php 
  $det = $mysqli->query("SELECT * FROM stanblog_users WHERE user = '$session_name'");
  $nums = mysqli_fetch_row($det);
  ?>
  <center>Your number: <font color="red"><?php echo $nums['4']; ?></font> |<a href="usercp.php?phone=number"> Edit</a></center>
  <center>Your city: <font color="red"><?php echo $nums['3']; ?></font> |<a href="usercp.php?new=city"> Edit</a></center>
  <br />
  </div>
  <?php echo $msg;?>
</div>
<?php 
}
if(isset($_GET['new']) == 'city') {
?>
<div class="panel panel-default">
  <div class="panel-heading">Update City</div>
  <div class="panel-body">
  <form method="POST" action="">
  <center><input type="text" class="form-control" name="city" placeholder="New city" /></center>
  <br />
  <center><button type='submit' name='newcitysubmit' class='btn btn-warning'>Change</button></center>
  </form>
  </div>
  <?php echo $msg;?>
</div>
<?php 
}
if(isset($_GET['phone']) == 'number') {
?>
<div class="panel panel-default">
  <div class="panel-heading">Update Phone Number</div>
  <div class="panel-body">
  <form method="POST" action="">
  <center><input type="text" pattern="[0-9]+" class="form-control" name="phonen" placeholder="New phone" /></center>
  <br />
  <center><button type='submit' name='phonesubmit' class='btn btn-warning'>Change</button></center>
  </form>
  </div>
  <?php echo $msg;?>
</div>
<?php 
}
?>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<ul>
						<li>
							<h2>Menu</h2>
							<ul>
								<li><a href="?avatar">Change avatar</a></li>
								<li><a href="?newpass">Change password</a></li>
								<li><a href="?details">Change details</a></li>
							</ul>
						</li>
<?php 
if ($ses->check_session()===false) {
?>
<h2>User Panel</h2>
<center><button class="btn btn-success" onclick="window.location.href='login.php'">Login</button> || <button class="btn btn-primary" onclick="window.location.href='register.php'">Register</button> </center>  
<?php 
} else {
?>
							<h2>User Panel</h2>
<?php
$avatar = $mysqli->query("SELECT * FROM stanblog_users WHERE user='$session_name'");
while ($row = $avatar->fetch_assoc()) {
?>
                            <center><img src="<?php echo $row['avatar']; ?>" width="50px" height="50px"></img></center>
							<center><a href="usercp.php?avatar">Change Your Avatar</a></center>
							<center><a href="usercp.php"> <font color='<?php echo $name_color; ?>'><?php echo $ses->get_session_name();?></a></font></center>
							<br />
							<center><button class="btn btn-danger" onclick="window.location.href='logout.php'">Logout</button></center>
<?php 
}
}
?>
					</ul>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
<?php include ("assets/adm/footer.php"); ?>
<!-- end #footer -->
</body>
</html>