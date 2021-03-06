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
				<p><?php echo WelcomeMsg;?> <a href="#" rel="nofollow"><?php echo $blog_name; ?></a></p>
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
 echo ("No post are specified! You make wrong turn ;(");
} 
$cpost = $mysqli->query("SELECT * FROM stanblog_posts WHERE postID='$id'");
while($row = $cpost->fetch_assoc()) {
?>
					<div class="post">
						<h2 class="title"><a href="#"><?php echo $row['postTitle']; ?> </a></h2>
						<p class="meta">Posted by <a href="#"><?php echo $row['postBy']; ?></a> on <?php echo $row['postDate']; ?>

						<div class="entry">
							<p><?php echo $row['postCont']; ?></p>
						</div>
					</div>
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