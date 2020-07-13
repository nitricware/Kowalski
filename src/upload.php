<?php
	include("./init.php");
	$error = 0;
	
	if ($_FILES["file"]["name"] == "") {
		// No File Specified
		$error++;
	}
	if (sha1($_POST["password"]) != $siteVars->passHash) {
		// Wrong Password
		$error++;
	}
	$date = strtotime($_POST["release"]);
	if (!$date) {
		// Invalid Release Date
		$error++;
	}
	
	if ($error == 0) {
		if ($_POST["type"] == "post") {
			$uploadPath = "./system/content/blog/";
			$fileName = $date.".md";
		} elseif ($_POST["type"] == "page") {
			$uploadPath = "./system/content/pages/";
			$fileName = $_FILES["file"]["name"];
		}
		
		$uploadfile = $uploadPath.$fileName;
		
		move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
		
		header("Location: admin.php?success=true");
	} else {
		header("Location: admin.php?error=$error");
	}