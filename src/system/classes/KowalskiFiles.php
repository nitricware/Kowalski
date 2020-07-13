<?php
	
	
	namespace NitricWare;
	
	
	class KowalsikFiles {
		
		private function getFiles(string $path = "./", string $extension = "md"): array {
			$return = array();
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
		
		public function getPages() {
			return $this->getFiles("./system/content/pages/");
		}
		
		public function getBlogPosts() {
			return $this->getFiles("./system/content/blog/");
		}
		
		public function getProjects() {
			return $this->getFiles("./system/content/frontpage/");
		}
	}