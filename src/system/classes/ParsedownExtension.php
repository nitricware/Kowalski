<?php
	
	/**
	 * Class KowalskiSyntaxMarkdown
	 *
	 * Extension for Parsedown that combines GeSHi with
	 * Parsedown.
	 */
	class KowalskiSyntaxMarkdown extends Parsedown {
		protected function blockFencedCodeComplete($Block) {
			// Creating a syntax highlighted fenced code block
			$geshi = new GeSHi(
				$Block["element"]["element"]["text"],
				str_replace(
					"language-",
					"",
					$Block["element"]["element"]["attributes"]["class"]
				)
			);
			$geshi->set_header_type(GESHI_HEADER_DIV);
			$Block["element"]["element"]["name"] = "div";
			$Block["element"]["element"]["attributes"]["class"] = "codeblock";
			$Block["element"] = $Block["element"]["element"];
			$Block["element"]["element"]["rawHtml"] = $geshi->parse_code();
			return $Block;
		}
    }