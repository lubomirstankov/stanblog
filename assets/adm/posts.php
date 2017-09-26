<?php 
   if (isset($_POST['submit'])) {
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "./assets/usr/avatars/".$unique_image;

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

// New city 

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

// New phone

if (isset($_POST['phonesubmit'])) {
	if (!empty($_POST['phonen'])) { 
	//
	$phonen = $mysqli->real_escape_string($_POST['phonen']);
	$ch = $mysqli->query("UPDATE stanblog_users SET phone='$phonen' WHERE user='$session_name'");
	if($ch) {
			$msg = "Success";
	} else {
		$msg = "This is not a number";
	}
	} else {
		$msg = "Please fill all fields";
	}
}