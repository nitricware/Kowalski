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
		public bool $isSticky = false;
	}
	
	$editor = new KowalskiEditorData();
	
	$tpl->load("./system/view/".$siteVars->adminDesign."/html/admin_editor.html");
	
	$editor->contentType = $_GET["type"];
	if (isset($_GET["file"])) {
		$editor->fileURL = $_GET["file"];
		$editor->fileName = pathinfo($editor->fileURL)["filename"];
		$editor->isSticky = (bool) strpos($editor->fileURL,"_sticky");
	} else {
		$time = time();
		$editor->fileURL = "./system/content/" . $editor->contentType . "/". $time . ".md";
		$editor->fileName = $time;
	}
	
	if (isset($_POST["content"])) {
		// save button in editor was pressed, data was sent via post
		// saving edits
		if ($_GET["type"] != "blog" && $_POST["fileName"] != $editor->fileName) {
			// filename was changed
			// this can happen during editing and creating
			//   - editing: file exists, rename
			//   - creating: file does not exist yet, do nothing
			$newName = strlen(trim($_POST["fileName"])) > 0 ? trim($_POST["fileName"]) : time();
			
			if (file_exists($editor->fileURL)) {
				unlink($editor->fileURL);
			}
			
			$editor->fileURL = "./system/content/" . $editor->contentType . "/". $newName . ".md";
			
			if (file_exists($editor->fileURL)) {
				$newName .= time();
				$editor->fileURL = "./system/content/" . $editor->contentType . "/". $newName . ".md";
			}
			$editor->fileName = $newName;
		}

		if (isset($_POST["isSticky"]) && $_POST["isSticky"] == "isSticky") {
			// A blog post was marked as sticky.
			if (!strpos($editor->fileURL, "_sticky")) {
				// it wasn't sticky before
				$newName = str_replace(".".pathinfo($editor->fileURL)["extension"],"_sticky.".pathinfo($editor->fileURL)["extension"], $editor->fileURL);
				rename($editor->fileURL, $newName);
				//unlink($editor->fileURL);
				$editor->fileURL = $newName;
				$editor->isSticky = true;
			}
		} else {
			// A blog post was marked as non-sticky.
			if (strpos($editor->fileURL, "_sticky")) {
				// it was sticky before
				$newName = str_replace("_sticky", "", $editor->fileURL);
				rename($editor->fileURL, $newName);
				//unlink($editor->fileURL);
				$editor->fileURL = $newName;
				$editor->isSticky = false;
			}
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