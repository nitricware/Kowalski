<?php
	class ParseProject {
		private $file;
		private $title;
		private $body;
		private $icon;
		private $download_fetched = false;	// Is set to true once the download link was parsed to prevent double preg_match call
		private $download_type;
		private $download_link;
		private $filename;
		
		function __construct(string $file) {
			if (file_exists($file)) {
				$this->file = file_get_contents($file);
				$this->filename = pathinfo($file)["filename"];
			}
		}
		
		function getProjectTitle() {
			$hPos = strpos($this->file, "# ") + 2;
			$lPos = strpos($this->file, "\n") - 2;
			$this->title = substr($this->file, $hPos, $lPos);
			
			return $this->title;
		}
		
		function getProjectBody() {
			$sPos = strpos($this->file, "\n") + 1;
			if (!$lPos = strpos($this->file, "\n", $sPos + 1)) {
				$lPos = strlen($this->file);
			}
			$this->body = substr($this->file, $sPos, $lPos);
			
			return $this->body;
		}
		
		function getDownload() {
			if (!$this->download_fetched) {
				$pattern = '/\[(appstore|github)\]\:\ (https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*))/';
				preg_match($pattern, $this->file,$result);
			
				if (count($result) > 0) {
					$this->download_type = $result[1];
					$this->download_link = $result[2];
				} else {
					$this->download_type = false;
					$this->download_link = false;
				}
				$this->download_fetched = true;
			}
			
			return [
				"type" => $this->download_type,
				"link" => $this->download_link
			];
		}
		
		function getProjectIcon() {
			$iconPath = "./system/content/frontpage/".$this->filename.".png";
			if (file_exists($iconPath)) {
				$this->icon = $iconPath;
			} else {
				return $this->icon = false;
			}
			
			return $this->icon;
		}
	}