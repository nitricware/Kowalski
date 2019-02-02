<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	//
	
	// Include the init file.
	include("./system/init.php");
	
	// Load the appropriate template
	$tpl->load("./system/view/".$siteVars->design."/html/blogpost.html");
	
	// Define the dir for the blogposts
	$blogDir = "./system/content/blog/";
	
	// Create a string holding the path to the blogpost file
	$file = $blogDir.$_GET["id"].".md";
	
	// Create an array holding the blog post (or false if the file does not exist)
	if (file_exists($file)) {
		$pp = new ParsePost($file);
		$md = new Parsedown();
		$md->setSafeMode(false);
		$md->setMarkupEscaped(false);
		$tpl->post = [
			"title" => $pp->getPostTitle(),
			"date" => $pp->getPostDate(),
			"body" => $md->text($pp->getPostBody())
		];
	} else {
		$tpl->post = false;
	}
	
	// Render the template
	echo $tpl->render();