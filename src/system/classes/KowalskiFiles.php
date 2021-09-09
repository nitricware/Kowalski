<?php
	
	namespace NitricWare;
	
	/**
	 * Class KowalskiFiles
	 *
	 * Scans the selected location for valid files
	 *
	 * @package NitricWare
	 */
	class KowalskiFiles {
		
		/**
		 * @param string $path
		 * @param string $extension
		 *
		 * @return array
		 */
		private function getFiles(
			string $path = "./",
			string $extension = "md"
		): array {
			$return = [];
			foreach (scandir($path) as $file) {
				if ($file != ".." && $file != ".") {
					$pathinfo = pathinfo($path.$file);
					if ($extension == "*" || $pathinfo["extension"] == $extension) {
						$return[] = $path.$file;
					}
				}
			}
			
			return $return;
		}
		
		/**
		 * Gets all pages.
		 *
		 * @return array
		 */
		public function getPages(): array {
			return $this->getFiles("./system/content/pages/");
		}
		
		/**
		 * Gets all blog posts.
		 *
		 * @return array
		 */
		public function getBlogPosts(): array {
			return $this->getFiles("./system/content/blog/");
		}
		
		/**
		 * Gets all projects.
		 *
		 * @return array
		 */
		public function getProjects(): array {
			return $this->getFiles("./system/content/frontpage/");
		}
	}