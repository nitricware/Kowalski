<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	use NitricWare\ParsePost;
	use NitricWare\Tonic;
	
	
	/** @var siteVars $siteVars */
	/** @var Tonic $tpl */
	include("./init.php");
	
	$tpl->load("./system/view/".$siteVars->design."/html/special.html");
	
	// Get all projects for the frontpage
	$specialDir = "./system/content/pages/";
	$specialFile = $specialDir.$_GET["page"].".md";
	
	if (file_exists($specialFile)) {
		$pp = new ParsePost($specialFile);
		$md = new KowalskiSyntaxMarkdown();
		$special = [
			"title" => $pp->getPostTitle(),
			"body" => $md->parse($pp->getPostBody())
		];
	} else {
		$special = false;
	}
	$tpl->special = $special;
	
	// Render the template
	echo $tpl->render();