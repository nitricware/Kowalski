<?php
	//
	//
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 27 Nov 21
	//
	
	use NitricWare\KowalskiFiles;
	use NitricWare\Tonic;
	
	/** @var Tonic $tpl */
	/** @var siteVars $siteVars */
	/** @var KowalskiFiles $files */
	include("./init.php");
	
	if (!isset($_COOKIE["kowalski_admin"])) {
		header("Location: admin_login.php");
		exit();
	}
	
	$accidentialCall = false;
	
	
	class KowalskiEditorData {
		public ?string $contentType = null;
		public ?string $content = null;
		public ?string $fileURL = null;
	}
	
	$editor = new KowalskiEditorData();
	
	$tpl->load("./system/view/".$siteVars->design."/html/admin_editor.html");
	
	// TODO: clean up that mess...
	
	switch ($_GET["type"]) {
		case "pages":
		case "blog":
		case "frontpage":
			$editor->contentType = $_GET["type"];
			break;
		default:
			$accidentialCall = true;
	}
	
	switch ($_GET["action"]) {
		case "new":
			break;
		case "save":
			if (!isset($_GET["file"])) {
				$editor->fileURL = "./system/content/" . $editor->contentType . "/". time() . ".md";
			} else {
				$editor->fileURL = $_GET["file"];
			}
			
			file_put_contents($editor->fileURL, $_POST["content"]);
		case "edit":
			if (isset($_GET["file"])) {
				$editor->fileURL = $_GET["file"];
			} else {
				if (!isset($editor->fileURL)) {
					$accidentialCall = true;
				}
			}
			
			$editor->content = file_get_contents($editor->fileURL);
			
			break;
		default:
			$accidentialCall = true;
	}
	
	if ($accidentialCall) {
		header("Location: admin.php");
	}
	
	$tpl->assign("editor", $editor);
	
	try {
		echo $tpl->render();
	} catch (Exception $e) {
		die("Error: ".$e->getMessage());
	}