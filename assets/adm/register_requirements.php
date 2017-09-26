<?php
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