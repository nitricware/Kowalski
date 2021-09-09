<?php
	
	
	namespace NitricWare;
	
	
	use Exception;
	
	class KowalskiProject {
		public string $title = "";
		public string $description = "";
		/** @var KowalskiProjectDownloadLinks[] $downloadLinks */
		public array $downloadLinks = [];
		public string|bool $iconPath = false;
		
		private string $projectFile = "";
		
		/**
		 * KowalskiProject constructor.
		 *
		 * @param string $path
		 *
		 * @throws Exception
		 */
		public function __construct (
			public string $path
		) {
			if (!file_exists($this->path)) {
				throw new Exception("Project file does not exist.");
			}
			
			if (!$this->projectFile = file_get_contents($this->path)) {
				throw new Exception("Couldn't read project file.");
			}
			
			$this->parseTitle();
			$this->parseDescription();
			$this->parseDownloadLinks();
			$this->getIconPath(pathinfo($this->path)["filename"]);
		}
		
		private function parseTitle (): void {
			$headlineStartPosition = strpos($this->projectFile, "# ") + 2;
			$headlineEndPosition = strpos($this->projectFile, "\n") - 2;
			$this->title = substr($this->projectFile, $headlineStartPosition, $headlineEndPosition);
		}
		
		private function parseDescription (): void {
			$firstLineBreak = strpos($this->projectFile, "\n") + 2;
			if (!$secondLineBreak = strpos($this->projectFile, "\n", $firstLineBreak)) {
				$secondLineBreak = strlen($this->projectFile);
			}
			
			$this->description = substr(
				$this->projectFile,
				$firstLineBreak,
				$secondLineBreak - $firstLineBreak
			);
		}
		
		private function parseDownloadLinks (): void {
			$pattern = '/\[(github|appstore)\]\:\ (https?:\/\/[www\.]?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/m';
			preg_match_all($pattern, $this->projectFile, $result);
			
			for ($i = 0; $i < count($result[0]); $i++) {
				$newLink = new KowalskiProjectDownloadLinks();
				$newLink->type = $result[1][$i];
				$newLink->link = $result[2][$i];
				$this->downloadLinks[] = $newLink;
			}
		}
		
		private function getIconPath (string $filename): void {
			$iconPath = "./system/content/frontpage/" . $filename . ".png";
			if (file_exists($iconPath)) {
				$this->iconPath = $iconPath;
			}
		}
	}
	
	class KowalskiProjectDownloadLinks {
		public string $type;
		public string $link;
	}