<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	function createHeaderItems() {
		$files = new \NitricWare\KowalsikFiles();
		$pages = $files->getPages();
		
		$pageArray = array();
		
		if (count($pages) > 0) {
			foreach($pages as $page) {
				if (!strpos($page, "hidden_")) {
					$pp = new ParsePost($page);
					$pageInfo = [
						"title" => $pp->getPostTitle(),
						"id" => substr($page, 0, -3)
					];
					
					$pageArray[] = $pageInfo;
				}
			}
		}
		
		return $pageArray;
	}