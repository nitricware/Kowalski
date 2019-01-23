<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	function createHeaderItems() {
		// Get all special pages
		$pagesDir = "./system/content/pages/";	
		$pagesFiles = scandir($pagesDir);
		
		if (count($pagesFiles) > 2) {
			foreach($pagesFiles as $page) {
				$completePath = $pagesDir.$page;
				if (pathinfo($completePath)["extension"] == "md" && !strpos($completePath, "hidden_")) {
					$pp = new ParsePost($completePath);
					$page = [
						"title" => $pp->getPostTitle(),
						"id" => substr($page, 0, -3)
					];
					
					$pages[] = $page;
				}
			}
		} else {
			$pages = false;
		}
		return $pages;
	}