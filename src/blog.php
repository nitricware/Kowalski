<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	include("./system/init.php");
	
	$tpl->load("./system/view/".$siteVars->design."/html/blog.html");
	
	// Get all projects for the frontpage
	$blogDir = "./system/content/blog/";	
	$blogFiles = array_reverse(scandir($blogDir));
	
	if (count($blogFiles) > 2) {
		foreach($blogFiles as $project) {
			$completePath = $blogDir.$project;
			if (pathinfo($completePath)["extension"] == "md") {
				$pp = new ParsePost($completePath);
				$md = new Parsedown();
				$post = [
					"title" => $pp->getPostTitle(),
					"stub" => substr($md->text($pp->getPostStub()),3,-4),
					"date" => $pp->getPostDate(),
					"id" => $pp->getID()
				];
				
				$posts[] = $post;
			}
		}
	} else {
		$posts = false;
	}
	$tpl->posts = $posts;
	
	// Render the template
	echo $tpl->render();