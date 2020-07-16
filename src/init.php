<?php
	// Include the dependencies
	include "vendor/autoload.php";
	// Header Items Function
	include("./system/header.php");
	// Markdown parser
	include("./system/classes/Parsedown.php");
	// File Parser
	include("./system/classes/ParseFile.php");
	// Blog Post Parser
	include("./system/classes/ParsePost.php");
	// Kowalski Files
	include("./system/classes/KowalskiFiles.php");
	// Site Variables
	include("./system/siteVars.php");
	$siteVars = new siteVars();
	
	$tpl = new \NitricWare\Tonic();
	
	// Get the items for the header navigation bar
	$pages = createHeaderItems();
	// Append the array of pages to the template
	$tpl->pages = $pages;
	
	// Read single parts of the date and time
	$day = date("d");
	$month = date("m");
	$minute = date("i");
	
	// Initate the messages array which holds the messages displayed right after the navigation bar
	$messages = [];
	
	// Check if the date is fitting for a message
	if (($day >= "24" || $day <= "27") && $month == "12") {
		$messages[] = "Happy Holiday! 🎄";
	} elseif ($day >= "31" && $month == "10") {
		$messages[] = "Happy Halloween! 🎃";	
	}
	
	
	// If the messages array is empty, assign it with boolean false
	if (count($messages) == 0) {
		$messages = false;
	}
	
	// Append messages and date parts to the template object.
	$tpl->messages = $messages;
	$tpl->day = $day;
	$tpl->month = $month;
	$tpl->minute = $minute;
	
	// Append the site vars to the template
	$tpl->siteVars = $siteVars;