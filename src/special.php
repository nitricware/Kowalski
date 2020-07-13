<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	include("./init.php");
	
	$tpl->load("./system/view/".$siteVars->design."/html/special.html");
	
	// Get all projects for the frontpage
	$specialDir = "./system/content/pages/";
	$specialFile = $specialDir.$_GET["page"].".md";
	
	if (file_exists($specialFile)) {
		$pp = new ParsePost($specialFile);
		$md = new Parsedown();
		$special = [
			"title" => $pp->getPostTitle(),
			"body" => $md->text($pp->getPostBody())
		];
	} else {
		$special = false;
	}
	$tpl->special = $special;
	
	// Render the template
	echo $tpl->render();