<?php
	include("./init.php");
	
	if (!isset($_COOKIE["kowalski_admin"])) {
		header("Location: admin_login.php");
		exit();
	}
	
	if (!isset($_GET["file"]) || !file_exists($_GET["file"])) {
		header("Location: admin.php");
	}
	
	unlink($_GET["file"]);
	
	header("Location: admin.php");