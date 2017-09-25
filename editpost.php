<?php session_start();
include ("inc/database.php");
include ("inc/config.php");
include ("inc/session_manager.class.php");

$ses = new session_manager();

if($ses->check_session()===false) {
	$session_name = "";
}  else {
$session_name = $ses->get_session_name();
}
$role_color = $mysqli->query("SELECT * FROM stanblog_users WHERE user='$session_name' AND role='admin'");
$num = mysqli_num_rows($role_color);
if ($num == 1) {
$name_color = "red";
} else if ($num != 1){
$name_color= "blue";
header("location: index.php");
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
if(isset($_GET['post'])) {
	$id = $mysqli->real_escape_string($_GET['post']);
} else if (empty($_GET['post'])) {
 $id = '';
 header("location:index.php");
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
	</center>
<?php 
}
?>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
<?php include ("assets/adm/sidebar.php"); ?>
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
