<?php
if (isset($_POST['submit-mt'])) {
if (!empty($_POST['maint'])) {
	
	$maint = $mysqli->real_escape_string($_POST['maint']);
	
	$inserter = $mysqli->query("UPDATE stanblog_titles SET main_title='$maint'");
	if ($inserter) {
		$msg = '<h4><div class="alert alert-success"> <center> You successfull update title!! </h4></div></center>';
	} else {
		$err = '<h4><div class="alert alert-danger"> <center> Some problem with insert a post!!! </h4></div></center> <br />'.$mysqli->errno;
	}
	
} else {
	$err = '<h4><div class="alert alert-danger"> <center> Please enter a title or text!! </h4></div></center>';
}
}
if (isset($_POST['submit-bt'])) {
	
	
if (!empty($_POST['bt'])) {
	
	$maint = $mysqli->real_escape_string($_POST['bt']);
	
	$inserter = $mysqli->query("UPDATE stanblog_titles SET blog_title='$maint'");
	if ($inserter) {
		$msg = '<h4><div class="alert alert-success"> <center> You successfull update title!! </h4></div></center>';
	} else {
		$err = '<h4><div class="alert alert-danger"> <center> Some problem with insert a post!!! </h4></div></center> <br />'.$mysqli->errno;
	}
	
} else {
	$err = '<h4><div class="alert alert-danger"> <center> Please enter a title or text!! </h4></div></center>';
}
}
if (isset($_POST['submit-bn'])) {
	
	
if (!empty($_POST['bn'])) {
	
	$maint = $mysqli->real_escape_string($_POST['bn']);
	
	$inserter = $mysqli->query("UPDATE stanblog_titles SET blog_name='$maint'");
	if ($inserter) {
		$msg = '<h4><div class="alert alert-success"> <center> You successfull update title!! </h4></div></center>';
	} else {
		$err = '<h4><div class="alert alert-danger"> <center> Some problem with insert a post!!! </h4></div></center> <br />'.$mysqli->errno;
	}
	
} else {
	$err = '<h4><div class="alert alert-danger"> <center> Please enter a title or text!! </h4></div></center>';
}
}
