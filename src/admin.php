<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	include("./init.php");
	
	$tpl->load("./system/view/".$siteVars->design."/html/admin.html");
	
	echo $tpl->render();