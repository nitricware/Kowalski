<?php
	
	namespace NitricWare;
	
	use KowalskiContentTypes;
	
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
		private function getPages(): array {
			return $this->getFiles("./system/content/pages/");
		}
		
		/**
		 * Gets all blog posts.
		 *
		 * @return array
		 */
		private function getBlogPosts(): array {
			return $this->getFiles("./system/content/blog/");
		}
		
		/**
		 * Gets all projects.
		 *
		 * @return array
		 */
		private function getProjects(): array {
			return $this->getFiles("./system/content/frontpage/");
		}
		
		/**
		 * @param KowalskiContentTypes $type
		 *
		 * @return ?array
		 */
		public function get(KowalskiContentTypes $type): ?array {
			return match ($type) {
				KowalskiContentTypes::page => $this->getPages(),
				KowalskiContentTypes::blog => $this->getBlogPosts(),
				KowalskiContentTypes::project => $this->getProjects(),
			};
		}
	}
	
	