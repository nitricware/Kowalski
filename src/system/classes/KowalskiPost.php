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
			$firstLineBreak = strpos($this->file, "\n") + 2;
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
			$t = pathinfo($this->path)["filename"];
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
	}