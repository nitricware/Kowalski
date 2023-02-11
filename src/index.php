<?php
	/**
		If there will ever be something to be placed before the frontpage,
		like an "under construction" page or - hopefully not - an ad, this
		page can easily be replaced.
		
		For now, it just forwards to the frontpage.
	*/
	
	use NitricWare\KowalskiContentTypes;
	
	/** @var siteVars $siteVars */
	include("./init.php");
	
	if ($siteVars->startPage == KowalskiContentTypes::project) {
		header("Location: frontpage.php");
	} else {
		header("Location: blog.php");
	}
	