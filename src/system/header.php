<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	use NitricWare\KowalskiContentTypes;
	use NitricWare\KowalskiFiles;
	use NitricWare\KowalskiPost;
	
	function createHeaderItems(): array {
		$files = new KowalskiFiles();
		$pages = $files->get(KowalskiContentTypes::page);
		
		$pageArray = array();
		
		if (count($pages) > 0) {
			foreach($pages as $page) {
				if (!strpos($page, "hidden_")) {
					try {
						$pp = new KowalskiPost($page);
					} catch (Exception $e) {
						die($e->getMessage());
					}
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