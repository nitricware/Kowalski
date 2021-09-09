<?php
	
	namespace NitricWare;
	
	
	/**
	 * Class ParseProject
	 *
	 * Parses a project file.
	 *
	 * @package NitricWare
	 */
	class ParseProject {
		private $filename;
		
		function __construct (
			private string $file
		) {
			if (file_exists($file)) {
				$this->file = file_get_contents($file);
				$this->filename = pathinfo($file)["filename"];
			}
		}
		
		/**
		 * Returns the first headline of the file
		 * as the project title.
		 *
		 * @return false|string
		 */
		function getProjectTitle () {
			$hPos = strpos($this->file, "# ") + 2;
			$lPos = strpos($this->file, "\n") - 2;
			return substr($this->file, $hPos, $lPos);
		}
		
		/**
		 * Returns the text between the first and the second
		 * line break as the project description.
		 *
		 * @return false|string
		 */
		function getProjectBody () {
			$firstLineBreak = strpos($this->file, "\n") + 2;
			if (!$secondLineBreak = strpos($this->file, "\n", $firstLineBreak)) {
				$secondLineBreak = strlen($this->file);
			}
			return substr($this->file, $firstLineBreak, $secondLineBreak - $firstLineBreak);
		}
		
		/**
		 * Checks for github or appstore download links
		 * and returns type and link.
		 *
		 * TODO: create object
		 * @return array
		 */
		function getDownload () {
			$pattern = '/\[(github|appstore)\]\:\ (https?:\/\/[www\.]?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/m';
			preg_match($pattern, $this->file, $result);
			if (count($result) > 0) {
				$download_type = $result[1];
				$download_link = $result[2];
			} else {
				$download_type = false;
				$download_link = false;
			}
			
			return [
				"type" => $download_type,
				"link" => $download_link
			];
		}
		
		/**
		 * Finds the corresponding project icon.
		 * 
		 * @return false|string
		 */
		function getProjectIcon () {
			$iconPath = "./system/content/frontpage/" . $this->filename . ".png";
			if (file_exists($iconPath)) {
				$icon = $iconPath;
			} else {
				return $icon = false;
			}
			
			return $icon;
		}
	}