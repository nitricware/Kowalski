<?php
	
	namespace NitricWare;
	
	class KowalskiFrontpageTextblock {
		public string $text = "";
		public function __construct (KowalskiFrontpageTextblockType $textblockType = KowalskiFrontpageTextblockType::header) {
			$textblockPath = __BASE_DIR__."/system/content/frontpage/".$textblockType->value;
			if (!file_exists($textblockPath)) {
				throw new \Exception("FrontpageTextblockType not found");
			}
			
			$this->text = file_get_contents($textblockPath);
		}
	}