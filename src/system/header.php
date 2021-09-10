<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	use NitricWare\KowalskiFiles;
	use NitricWare\KowalskiPost;
	
	function createHeaderItems(): array {
		$files = new KowalskiFiles();
		$pages = $files->getPages();
		
		$pageArray = array();
		
		if (count($pages) > 0) {
			foreach($pages as $page) {
				if (!strpos($page, "hidden_")) {
					$pp = new KowalskiPost($page);
					$pageInfo = [
						"title" => $pp->getPostTitle(),
						"id" => $pp->getID(),
					];
					
					$pageArray[] = $pageInfo;
				}
			}
		}
		
		return $pageArray;
	}