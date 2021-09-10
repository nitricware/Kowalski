<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	use NitricWare\KowalskiPost;
	use NitricWare\Tonic;
	
	/** @var siteVars $siteVars */
	/** @var Tonic $tpl */
	include("./init.php");
	
	$tpl->load("./system/view/".$siteVars->design."/html/special.html");
	
	// Get all projects for the frontpage
	$specialDir = "./system/content/pages/";
	$specialFile = $specialDir.$_GET["page"].".md";
	
	try {
		$pp = new KowalskiPost($specialFile);
		$md = new KowalskiSyntaxMarkdown();
		$special = [
			"title" => $pp->getPostTitle(),
			"body" => $md->parse($pp->getPostBody())
		];
	} catch (Exception $e) {
		$special = false;
	}
	
	$tpl->assign("special", $special);
	
	// Render the template
	try {
		echo $tpl->render();
	} catch (Exception $e) {
		die("Error displaying special page.");
	}