				<div id="sidebar">
					<ul>
						<li>
<?php 
if (!isset($_SESSION['stanblog'])) {
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
							<center><a href="usercp.php"> <font color='<?php echo $name_color; ?>'><?php echo $ses->get_session_name();; ?></a></font></center>
							<br />
							<center><button class="btn btn-danger" onclick="window.location.href='logout.php'">Logout</button></center>
<?php 
}
}
?>
						</li>
						<li>
						<?php
						$newsf = $mysqli->query("SELECT * FROM stanblog_news_bar");
						while ($row = $newsf->fetch_assoc()){
					    ?>
							<h2><?php echo $row['news_title']; ?></h2>
							<p><?php echo $row['news_text']; ?></p>
						<?php
						}
						?>
						</li>
						<li>
							<h2>Latest Posts</h2>
							<ul>
<?php 
$lpost = $mysqli->query("SELECT * FROM stanblog_posts ORDER BY postDate DESC LIMIT 3");
while ($row = $lpost->fetch_assoc()) {
?>
								<li><a href="readpost.php?post=<?php echo $row['id']; ?>"><?php echo $row['postTitle'];?></a></li>
<?php 
}
?>
							</ul>
						</li>
					</ul>
				</div>