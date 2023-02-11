<?php
	//
	//
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 27 Nov 21
	//
	
	/** @var Tonic $tpl */
	/** @var siteVars $siteVars */
	/** @var KowalskiFiles $files */
	include("./init.php");
	
	use NitricWare\KowalskiFiles;
	use NitricWare\Tonic;
	
	if (!isset($_COOKIE["kowalski_admin"])) {
		header("Location: admin_login.php");
		exit();
	}
	
	class KowalskiEditorData {
		public ?string $contentType = null;
		public string $content = "";
		public ?string $fileURL = null;
		public ?string $fileName = null;
	}
	
	$editor = new KowalskiEditorData();
	
	$tpl->load("./system/view/".$siteVars->design."/html/admin_editor.html");
	
	$editor->contentType = $_GET["type"];
	if (isset($_GET["file"])) {
		$editor->fileURL = $_GET["file"];
		$editor->fileName = pathinfo($editor->fileURL)["filename"];
	} else {
		$time = time();
		$editor->fileURL = "./system/content/" . $editor->contentType . "/". $time . ".md";
		$editor->fileName = $time;
	}
	
	if (isset($_POST["content"])) {
		// save button in editor was pressed, data was sent via post
		// saving edits
		if ($_POST["fileName"] != $editor->fileName) {
			// filename was changed
			$newName = strlen(trim($_POST["fileName"])) > 0 ? trim($_POST["fileName"]) : time();
			unlink($editor->fileURL);
			$editor->fileURL = "./system/content/" . $editor->contentType . "/". $newName . ".md";
			$editor->fileName = $newName;
		}
		file_put_contents($editor->fileURL, $_POST["content"]);
	}
	
	
	switch ($_GET["action"]) {
		case "new":
			break;
		case "edit":
			$editor->content = file_get_contents($editor->fileURL);
			break;
	}
	
	$tpl->assign("editor", $editor);
	
	try {
		echo $tpl->render();
	} catch (Exception $e) {
		die("Error: ".$e->getMessage());
	}