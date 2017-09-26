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
<?php include ("pages.php"); ?>
		</ul>
	</div>
	<!-- end #menu -->
					<?php 
					if (isset($_GET['all'])) {
						$desc = "9999999";
						$html = '<center><a href="index.php">Back to normal</a></center>';
					} else {
						$desc = "5";
						$html = '<center><a href="?all">All posts</a></center>';
					}
					?>
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
				<?php
				$posts = $mysqli->query("SELECT * FROM stanblog_posts ORDER BY postDate DESC LIMIT 0,$desc");
				while($row = $posts->fetch_assoc()) {
				?>
					<div class="post">
						<h2 class="title"><a href="readpost.php?post=<?php echo $row['postID']; ?>"><?php echo $row['postTitle']; ?> </a></h2>
						<p class="meta">Posted by <a href="#"><?php echo $row['postBy']; ?></a> on <?php echo $row['postDate']; ?>

						<div class="entry">
							<p><?php echo $row['postCont']; ?></p>
						</div>
						<?php 
						$checkif = $mysqli->query("SELECT * FROM stanblog_users WHERE user='$session_name' AND role='admin'");
						$rowsnum = mysqli_num_rows($checkif);
						if ($rowsnum==1) {
						?>
						<a href="bl-adm/edit-post.php?post=<?php echo $row['postID']; ?>">Edit</a>
						<?php 
						} 
						?>
					</div>
				<?php 
				}
				?>
					<div style="clear: both;">&nbsp;</div>
					<?php echo $html;?>
				</div>
				<!-- end #content -->
<?php include ("assets/adm/sidebar.php"); ?>
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