<?php
	class ParsePost {
		private $path;
		private $file;
		private $title;
		private $body;
		private $stub;
		private $date;
		
		function __construct(string $file) {
			if (file_exists($file)) {
				$this->file = file_get_contents($file);
				$this->path = $file;
			}
		}
		
		function getPostTitle() {
			$hPos = strpos($this->file, "# ") + 2;
			$lPos = strpos($this->file, "\n") - 2;
			$this->title = substr($this->file, $hPos, $lPos);
			
			return $this->title;
		}
		
		function getPostBody() {
			$sPos = strpos($this->file, "\n") + 1;
			$this->body = substr($this->file, $sPos);
			
			return $this->body;
		}
		
		function getPostStub() {
			$s = strpos($this->file, "\n") + 2;
			$e = strpos($this->file, "\n", strpos($this->file, "\n") + 4);
			$this->stub = substr($this->file, $s, $e - $s);
			
			return $this->stub;
		}
		
		function getPostDate() {
			$t = filemtime($this->path);
			$d = date("d.m.Y", $t);
			$this->date = $d;
			
			return $this->date;
		}
		
		function getID() {
			return pathinfo($this->path)["filename"];
		}
	}