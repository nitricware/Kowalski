<?php
	//
	//
	// NW 2019
	//
	// by Kurt Höblinger aka NitricWare
	// Started on 19 Jan 19
	//
	
	include("./system/init.php");
	
	// This page displays the frontpage
	// It shows an overview over currently developed applications	
	
	$tpl->load("./system/view/".$siteVars->design."/html/frontpage.html");
	
	// Get all projects for the frontpage
	$projectsDir = "./system/content/frontpage/";	
	$projectsFiles = scandir($projectsDir);
	
	// There are always 2 entries in the array: "." and ".."
	// We assume there are valid projects files when there are more than 2 entries
	// TODO: Check for valid project files
	//
	// Then create an array holding all information about the single projects and append it to the template
	
	if (count($projectsFiles) > 2) {
		foreach($projectsFiles as $project) {
			$completePath = $projectsDir.$project;
			if (pathinfo($completePath)["extension"] == "md") {
				$pp = new ParseProject($completePath);
				$project = [
					"title" => $pp->getProjectTitle(),
					"body" => $pp->getProjectBody(),
					"icon_path" => $pp->getProjectIcon(),
					"download_type" => $pp->getDownload()["type"],
					"download_link" => $pp->getDownload()["link"]
				];
				
				$projects[] = $project;
			}
		}
	} else {
		$projects = false;
	}
	$tpl->projects = $projects;
	
	// Render the template
	echo $tpl->render();