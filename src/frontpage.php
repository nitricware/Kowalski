<?php
	error_reporting(E_ALL);
	//
	//
	// Kowalski
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	use NitricWare\KowalskiContentTypes;
	use NitricWare\KowalskiFrontpageTextblock;
	use NitricWare\KowalskiFrontpageTextblockType;
	use NitricWare\KowalskiProject;
	use NitricWare\KowalskiFiles;
	use NitricWare\Tonic;
	
	// use NitricWare\ParseProject;
	
	/** @var Tonic $tpl */
	/** @var siteVars $siteVars */
	/** @var KowalskiFiles $files */
	include("./init.php");
	
	// This page displays the frontpage
	// It shows an overview over currently developed applications	
	
	$tpl->load("./system/view/".$siteVars->design."/html/frontpage.html");
	
	$tpl->assign("pageType", "frontpage");
	
	// Get all projects for the frontpage
	$projectsDir = "./system/content/frontpage/";	
	$projectsFiles = $files->get(KowalskiContentTypes::project);
	
	$projects = [];
	
	foreach ($projectsFiles as $projectFile) {
		if (strpos($projectFile, "header.md")) {
			break;
		}
		if (strpos($projectFile, "footer.md")) {
			break;
		}
		try {
			$projects[] = new KowalskiProject($projectFile);
		} catch (Exception $e) {
			echo ("Error: ".$e->getMessage());
		}
	}
	
	if (count($projects) < 1) {
		$projects = false;
	}
	
	$tpl->assign("projects", $projects);
	
	/**
	 * The header and the footer message can be edited
	 * by changing (or deleting) header.md and footer.md
	 * in `content/frontpage/`.
	 */
	
	// Create an array holding the blog post (or false if the file does not exist)
	try {
		$frontpageHeader = new KowalskiFrontpageTextblock(KowalskiFrontpageTextblockType::header);
		$md = new KowalskiSyntaxMarkdown();
		$md->setSafeMode(false);
		$md->setMarkupEscaped(false);
		$tpl->assign(
			"headerText", $md->text($frontpageHeader->text)
		);
	} catch (Exception $e) {
		$tpl->assign("headerText", false);
	}
	
	// Create an array holding the blog post (or false if the file does not exist)
	try {
		$frontpageFooter = new KowalskiFrontpageTextblock(KowalskiFrontpageTextblockType::footer);
		$md = new KowalskiSyntaxMarkdown();
		$md->setSafeMode(false);
		$md->setMarkupEscaped(false);
		$tpl->assign(
			"footerText", $md->text($frontpageFooter->text)
		);
	} catch (Exception $e) {
		$tpl->assign("footerText", false);
	}
	
	// Render the template
	try {
		echo $tpl->render();
	} catch (Exception $e) {
		die ("Error rendering template.");
	}