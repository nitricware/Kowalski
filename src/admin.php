<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	use NitricWare\KowalskiFiles;
	
	include("./init.php");
	
	if (!isset($_COOKIE["kowalski_admin"])) {
		header("Location: admin_login.php");
		exit();
	}
	
	$adminPanel = new KowalskiFiles();
	
	$tpl->assign("pagesFiles", $adminPanel->getPages());
	$tpl->assign("blogPosts", $adminPanel->getBlogPosts());
	$tpl->assign("projects", $adminPanel->getProjects());
	
	$tpl->load("./system/view/".$siteVars->design."/html/admin.html");
	
	echo $tpl->render();