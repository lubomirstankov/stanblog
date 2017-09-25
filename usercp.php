<?php session_start();
include ("inc/database.php");
include ("inc/config.php");
include ("inc/session_manager.class.php");
$img = "";
$msg = "";

$ses = new session_manager();

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

//FP
   if (isset($_POST['submit'])) {
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "assets/usr/avatars/".$unique_image;

    move_uploaded_file($file_temp, $uploaded_image);
	$query = $mysqli->query("UPDATE stanblog_users SET avatar='$uploaded_image' WHERE user='$session_name'");
	if ($query) {
    if ($file_size < 1048567) {
		$img = "Success";
	} else {
     $img = "Please upload image less than 1 mb";
    }
   }
}
//FP END

//New pass

if (isset($_POST['sub'])) {
	if (!empty($_POST['skey']) || !empty($_POST['newpass'])) { 
	//
	$skey = $mysqli->real_escape_string($_POST['skey']);
	$newpass = $mysqli->real_escape_string($_POST['newpass']);
	
	$skeycheck = $mysqli->query("SELECT * FROM stanblog_users WHERE user='$session_name' AND skey='$skey'");
	$skeyc = mysqli_num_rows($skeycheck);
	if ($skeyc == 1) {
		$pasenc=sha1(sha1("as213456sd4565!@#^&%*&%&**)*(@#&*@#".$newpass."as213456sd4565!@#^&%*&%&**)*(@#&*@#"));
		$mysqli->query("UPDATE stanblog_users SET pass='$pasenc' WHERE user='$session_name'");
		session_unset();
		session_destroy();
		$msg = "Success";
	} else {
		$msg = "Your secret key doesnt match..";
	}
	} else {
		$msg = "Please fill all fields";
	}
}

// New phone 

if (isset($_POST['newcitysubmit'])) {
	if (!empty($_POST['city'])) { 
	//
	$newcity = $mysqli->real_escape_string($_POST['city']);
	$ch = $mysqli->query("UPDATE stanblog_users SET city='$newcity' WHERE user='$session_name'");
	if($ch) {
			$msg = "Success";
	} else {
		$msg = "This is not a number";
	}
	} else {
		$msg = "Please fill all fields";
	}
}
?>
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
  <center>Your number: <font color="red"><?php echo $nums['4']; ?></font> |<a href="usercp.php?editdetails=number"> Edit</a></center>
  <center>Your city: <font color="red"><?php echo $nums['3']; ?></font> |<a href="usercp.php?editdetails=city"> Edit</a></center>
  <br />
  </div>
  <?php echo $msg;?>
</div>
<?php 
}
if(isset($_GET['editdetails']) == 'city') {
?>
<div class="panel panel-default">
  <div class="panel-heading">Update City Number</div>
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
