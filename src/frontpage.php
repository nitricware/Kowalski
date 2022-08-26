<?php
	error_reporting(E_ALL);
	//
	//
	// Kowalski
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	use NitricWare\KowalskiFiles;
	use NitricWare\KowalskiProject;
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
	
	// Render the template
	try {
		echo $tpl->render();
	} catch (Exception $e) {
		die ("Error rendering template.");
	}