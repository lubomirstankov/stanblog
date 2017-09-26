<?php 
if(isset($_POST['submit'])) {
    if (!empty($_POST['usern']) && !empty($_POST['pass'])) {
        $usern = $mysqli->real_escape_string($_POST['usern']);
        $pass = $mysqli->real_escape_string($_POST['pass']);
        $pasenc=sha1(sha1("as213456sd4565!@#^&%*&%&**)*(@#&*@#".$pass."as213456sd4565!@#^&%*&%&**)*(@#&*@#"));
        $rows = $mysqli->query("SELECT * FROM stanblog_users WHERE user='$usern' AND pass='$pasenc'");
        $ifexist = mysqli_num_rows($rows);
        if($ifexist!=0) {
           session_start();
           $_SESSION['stanblog']=$usern;
           header("location: index.php");
		   if(isset($_GET['adm'])) {
           session_start();
           $_SESSION['stanblog']=$usern;
           header("location: bl-adm"); 
		   }
        } else {
 $error = '<h4><div class="alert alert-danger"> <center> Your username or password are incorrect! </h4></div></center>';
        }
    } else {
     $error = '<h4><div class="alert alert-danger"> <center> Please enter some username and password! </h4></div></center>';
    }
}