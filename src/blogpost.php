<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	//
	
	use NitricWare\KowalskiPost;
	use NitricWare\Tonic;
	
	/** @var siteVars $siteVars */
	/** @var Tonic $tpl */
	include("./init.php");
	
	// Load the appropriate template
	$tpl->load("./system/view/".$siteVars->design."/html/blogpost.html");
	
	// Define the dir for the blogposts
	$blogDir = "./system/content/blog/";
	
	// Create a string holding the path to the blogpost file
	$file = $blogDir.$_GET["id"].".md";
	
	// Create an array holding the blog post (or false if the file does not exist)
	try {
		$pp = new KowalskiPost($file);
		$md = new Parsedown();
		$md->setSafeMode(false);
		$md->setMarkupEscaped(false);
		$tpl->assign(
			"post",
			[
				"title" => $pp->getPostTitle(),
				"date" => $pp->getPostDate(),
				"body" => $md->text($pp->getPostBody())
			]
		);
	} catch (Exception $e) {
		$tpl->assign("post", false);
	}
	
	// Render the template
	try {
		echo $tpl->render();
	} catch (Exception $e) {
		die("Error displaying blog post.");
	}