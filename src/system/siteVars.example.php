<?php
	
	use NitricWare\KowalskiContentTypes;
	
	/**
	 * siteVars holds the settings.
	 */
	class siteVars {
		/**
		 * Developer name.
		 * @var string
		 */
		public string $name = "Developer Name";
		/**
		 * Developer Company Name or alias
		 * @var string
		 */
		public string $company = "Company";
		/**
		 * Path To Logo
		 * @var string
		 */
		public string $logoPath = "./system/view/default/images/Kowalski.png";
		/**
		 * GitHub handle (set to false to disable)
		 * @var bool|string
		 */
		public bool|string $github = false;
		/**
		 * Password (SHA1-Hash)
		 * @var bool|string
		 */
		public bool|string $passHash = false;
		/**
		 * Design
		 * @var string
		 */
		public string $design = "default";
		/**
		 * Introduction Text
		 * @var string
		 */
		public string $introText = "Describe yourself.";
		/**
		 * Show link to admin interface if theme supports it?
		 * @var bool
		 */
		public bool $linkToAdmin = true;
		/**
		 * Which section should be the startpage? Projects or blog?
		 * @var KowalskiContentTypes
		 */
		public KowalskiContentTypes $startPage = KowalskiContentTypes::project;
		/**
		 * Use GeSHi's class system for highlight or color in HTML?
		 * Set to true for classes. Requires extra CSS.
		 * @var bool
		 */
	}
	
	const GESHI_CLASSES = true;