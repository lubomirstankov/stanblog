<?php
include ("inc/database.php");
include ("inc/config.php");
$msg = "";
if(isset($_POST['register'])){
if(!empty($_POST['username']) && !empty($_POST['password'])) {

$user=$mysqli->real_escape_string($_POST['username']);
$pass=$mysqli->real_escape_string($_POST['password']);
$city=$mysqli->real_escape_string($_POST['city']);
$skey=$mysqli->real_escape_string($_POST['skey']);
$phone=$mysqli->real_escape_string($_POST['phone']);

$query=$mysqli->query("SELECT * FROM stanblog_users WHERE user='".$user."'");
$numrows=mysqli_num_rows($query);


if($numrows==0){
$pasenc=sha1(sha1("as213456sd4565!@#^&%*&%&**)*(@#&*@#".$pass."as213456sd4565!@#^&%*&%&**)*(@#&*@#"));
$sql="INSERT INTO stanblog_users (user,skey,avatar,city,phone,pass,role) VALUES ('$user','$skey','assets/usr/avatars/def.png', '$city', '$phone', '$pasenc', 'user')";
$result=$mysqli->query($sql);
if($result!=1) {
 $msg = '<h4><div class="alert alert-danger"> <center> Ohh.. Something is failed!! </h4></div></center>';
 } else{
echo "<script>alert('You successfull create your account')</script>";
echo "<script>window.location.href='login.php'</script>";
   }
  } else {
 $msg = '<h4><div class="alert alert-danger"> <center> Ohh.. Account With That username Exist!! </h4></div></center>';
  }
 } else {
 $msg = '<h4><div class="alert alert-danger"> <center> Ohh.. Please enter data!! </h4></div></center>';
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Black / White   
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20111121

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $main_title; ?></title>
<link href='http://fonts.googleapis.com/css?family=Nova+Mono' rel='stylesheet' type='text/css' />
<link href="assets/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="assets/forms.css" rel="stylesheet" type="text/css"/>
<link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
<script type="text/css">

</script>
</head>
<body>
    <div class="wrapper">
    <form class="form-signin" method="POST" action="">       
      <h2 class="form-signin-heading">Please register</h2>
      <input type="text" class="form-control" name="username" placeholder="UserName" required autofocus="" />
	  <br />
      <input type="password" min="6" class="form-control" name="password" placeholder="Password" /> 
     <br />
      <input type="text" class="form-control" name="city" placeholder="City" />     
<br />	  
      <input type="text" pattern="[0-9]+" class="form-control" name="phone" placeholder="Phone Number" />
<br />	
      <input type="text" class="form-control" name="skey" placeholder="Some word only you know!!" />    
<br />	  
      <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Register</button>
<a href="login.php">I have already account!</a>	  
    </form>
	<?php echo $msg;?>
  </div>
</body>