<?php
	
	namespace NitricWare;
	
	use Exception;
	
	/**
	 * Class KowalskiPost
	 *
	 * Parses a blog post file.
	 *
	 * @package NitricWare
	 */
	class KowalskiPost {
		private string $path;
		
		/**
		 * @throws Exception
		 */
		function __construct(
			private string $file
		) {
			if (file_exists($file)) {
				$this->file = file_get_contents($file);
				$this->path = $file;
			} else {
				throw new Exception("File does not exist.");
			}
		}
		
		/**
		 * Scans for the first headline and returns it as
		 * the post title.
		 *
		 * @return string
		 */
		function getPostTitle(): string {
			$hPos = strpos($this->file, "# ") + 2;
			$lPos = strpos($this->file, "\n") - 2;
			return substr($this->file, $hPos, $lPos);
		}
		
		/**
		 * Scans for text after the first line break and
		 * returns the rest of the file as the body,
		 * including links.
		 *
		 * @return false|string
		 */
		function getPostBody(): false|string {
			$sPos = strpos($this->file, "\n") + 1;
			return substr($this->file, $sPos);
		}
		
		/**
		 * Returns the text between the first and the second
		 * line break as a stub of the blog post.
		 *
		 * @return string
		 */
		function getPostStub(): string {
			$firstLineBreak = strpos($this->file, "\n") + 3;
			$secondLineBreak = strpos($this->file, "\n", $firstLineBreak);
			
			return substr($this->file, $firstLineBreak, $secondLineBreak - $firstLineBreak);
		}
		
		/**
		 * The date of the post is stored in the file name.
		 * Parses the filename and returns a date.
		 *
		 * TODO: localize date output
		 *
		 * @return false|string
		 */
		function getPostDate(): bool|string {
			/*
			 * Filename could contain underscores ("_hidden", "_sticky").
			 * If it does, anything uo until the first underscore is
			 * considered the date of the post.
			 */
			$u = strpos(pathinfo($this->path)["filename"], "_");
			$t = substr(pathinfo($this->path)["filename"],0, $u ? $u : null);
			return date("d.m.Y", $t);
		}
		
		/**
		 * Returns the filename as the blog post ID.
		 *
		 * @return string
		 */
		function getID(): string {
			return pathinfo($this->path)["filename"];
		}
		
		function getSticky(): bool {
			return (bool) strpos(pathinfo($this->path)["filename"], "_sticky");
		}
	}