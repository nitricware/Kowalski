<?php
	class KowalskiSyntaxMarkdown extends Parsedown {
		protected function blockFencedCodeComplete($Block)
		{
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
			$Block["element"]["element"]["text"] = $geshi->parse_code();
			$Block["element"]["element"]["name"] = "div";
			$Block["element"]["element"]["attributes"]["class"] = "codeblock";
			$Block["element"] = $Block["element"]["element"];
			return $Block;
		}
		
		protected function element(array $Element)
		{
			if ($this->safeMode)
			{
				$Element = $this->sanitiseElement($Element);
			}
			
			# identity map if element has no handler
			$Element = $this->handle($Element);
			
			$hasName = isset($Element['name']);
			
			$markup = '';
			
			if ($hasName)
			{
				$markup .= '<' . $Element['name'];
				
				if (isset($Element['attributes']))
				{
					foreach ($Element['attributes'] as $name => $value)
					{
						if ($value === null)
						{
							continue;
						}
						
						$markup .= " $name=\"".self::escape($value).'"';
					}
				}
			}
			// NitricWare edit: allows raw HTML
			
			if ($Element["attributes"]["class"] == "codeblock") {
				$permitRawHtml = true;
			} else {
				$permitRawHtml = false;
			}
			
			if (isset($Element['text']))
			{
				$text = $Element['text'];
			}
			// very strongly consider an alternative if you're writing an
			// extension
			elseif (isset($Element['rawHtml']))
			{
				$text = $Element['rawHtml'];
				
				$allowRawHtmlInSafeMode = isset($Element['allowRawHtmlInSafeMode']) && $Element['allowRawHtmlInSafeMode'];
				$permitRawHtml = !$this->safeMode || $allowRawHtmlInSafeMode;
			}
			
			$hasContent = isset($text) || isset($Element['element']) || isset($Element['elements']);
			
			if ($hasContent)
			{
				$markup .= $hasName ? '>' : '';
				
				if (isset($Element['elements']))
				{
					$markup .= $this->elements($Element['elements']);
				}
				elseif (isset($Element['element']))
				{
					$markup .= $this->element($Element['element']);
				}
				else
				{
					if (!$permitRawHtml)
					{
						$markup .= self::escape($text, true);
					}
					else
					{
						$markup .= $text;
					}
				}
				
				$markup .= $hasName ? '</' . $Element['name'] . '>' : '';
			}
			elseif ($hasName)
			{
				$markup .= ' />';
			}
			
			return $markup;
		}
    }