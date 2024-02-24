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
	
	
	$tpl->load("./system/view/".$siteVars->design."/html/blog.html");
	
	// Get all projects for the frontpage
	$blogDir = "./system/content/blog/";	
	$blogFiles = array_reverse(scandir($blogDir));
	$posts = [];
	$stickyPosts = [];
	
	if (count($blogFiles) > 2) {
		foreach($blogFiles as $project) {
			$completePath = $blogDir.$project;
			if (pathinfo($completePath)["extension"] == "md") {
				try {
					$pp = new KowalskiPost($completePath);
					$md = new Parsedown();
					$post = [
						"title" => $pp->getPostTitle(),
						"stub" => substr($md->text($pp->getPostStub()),3,-4),
						"date" => $pp->getPostDate(),
						"id" => $pp->getID(),
						"isSticky" => $pp->getSticky()
					];
					if ($post["isSticky"]) {
						$stickyPosts[] = $post;
					} else {
						$posts[] = $post;
					}
				} catch (Exception $e) {
					trigger_error("Post does not exist anymore", E_USER_NOTICE);
				}
			}
		}
	} else {
		$posts = false;
		$stickyPosts = false;
	}
	
	if (count($stickyPosts) < 1) {
		$stickyPosts = false;
	}
	
	$tpl->assign("stickyPosts", $stickyPosts);
	$tpl->assign("posts", $posts);
	
	// Render the template
	try {
		echo $tpl->render();
	} catch (Exception $e) {
		die("Error displaying blog.");
	}