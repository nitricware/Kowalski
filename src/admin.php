<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
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
	
	$adminPanel = new KowalskiFiles();
	
	$tpl->assign("pagesFiles", $adminPanel->get(KowalskiContentTypes::page));
	$tpl->assign("blogPosts", $adminPanel->get(KowalskiContentTypes::blog));
	$tpl->assign("projects", $adminPanel->get(KowalskiContentTypes::project));
	
	$tpl->load("./system/view/".$siteVars->design."/html/admin.html");
	
	try {
		echo $tpl->render();
	} catch (Exception $e) {
		die("Error: ".$e->getMessage());
	}