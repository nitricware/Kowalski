<?php
	/*
	 * Autoloader
	 */
	
	use NitricWare\KowalskiFrontpageMessages;
	
	const __BASE_DIR__ = __DIR__;
	
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
	/** @var KowalskiFrontpageMessages[] $frontpageMessages */
	include("./system/frontpageMessages.php");
	$siteVars = new siteVars();
	// Header Items Function
	include("./system/header.php");
	
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
	$now = new DateTimeImmutable();
	$messages = [];
	foreach ($frontpageMessages as $message) {
		if ($now->getTimestamp() >= $message->startTime->getTimestamp() &&
			$now->getTimestamp() <= $message->endTime->getTimestamp()) {
			$messages[] = $message->message;
		}
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