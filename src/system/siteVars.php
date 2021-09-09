<?php
	class siteVars {
		// Developer Name
		public $name = "Kurt Höblinger";
		// Developer Company Name
		public $company = "NitricWare";
		// Path To Logo
		public $logoPath = "./system/view/NW2019/images/NWLogo200.png";
		// GitHub handle (set to false to disable)
		public $github = false;
		// Password (SHA1-Hash)
		public $passHash = false;
		// Design
		public $design = "NW2021";
		// Introduction Text
		public $introText = "I am a Digital Healthcare engineer - not just since I finished my Master's Degree at St. Pölten University of Applied Sciences - and a physio therapist. Maybe you’d like to check out my repositories on GitHub, read my dev-blog or have a look at my portfolio.";
		
		public function __construct () {
			$this->passHash = sha1("hello");
		}
	}