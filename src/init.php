<?php
	/*
	 * Autoloader
	 */
	
	include __DIR__."/vendor/autoload.php";
	/**
	 * NWAutoLoad - automatically includes used classes, enums, etc.
	 *
	 * @param string $name is transformed into a path. Namespace\Class
	 * becomes Namespace/Class. Class.php is expected to be located in
	 * system/classes/Namespace/Class.php.
	 *
	 * @return void
	 */
	function NWAutoLoad (string $name): void {
		// Resolve namespaces into directories
		$path = str_replace("\\", "/", $name);
		if (file_exists(__DIR__ . "/system/classes/$path.php")) {
			include __DIR__ . "/system/classes/$path.php";
		} elseif (file_exists(__DIR__ . "/system/enums/$path.php")) {
			include __DIR__ . "/system/enums/$path.php";
		}
	}
	
	spl_autoload_register("NWAutoLoad");
	
	// Site Variables
	include("./system/siteVars.php");
	// Header Items Function
	include("./system/header.php");
	
	$siteVars = new siteVars();
	
	$tpl = new NitricWare\Tonic();
	$files = new NitricWare\KowalskiFiles();
	
	// Get the items for the header navigation bar
	$pages = createHeaderItems();
	// Append the array of pages to the template
	$tpl->assign("pages", $pages);
	
	// Read single parts of the date and time
	$day = date("d");
	$month = date("m");
	$minute = date("i");
	
	// Initiate the messages array which holds the messages displayed right after the navigation bar
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
	$tpl->assign("messages", $messages);
	$tpl->assign("day", $day);
	$tpl->assign("month", $month);
	$tpl->assign("minute", $minute);
	
	// Append the site vars to the template
	$tpl->assign("siteVars", $siteVars);