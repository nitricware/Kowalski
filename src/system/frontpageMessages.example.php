<?php
	
	use NitricWare\KowalskiFrontpageMessages;
	
	$frontpageMessages = [
		new KowalskiFrontpageMessages(
			new DateTimeImmutable("24. December"),
			new DateTimeImmutable("24. December"),
			"Happy Holiday! 🎄"
		),
		new KowalskiFrontpageMessages(
			new DateTimeImmutable("31. October"),
			new DateTimeImmutable("31. October"),
			"Happy Halloween! 🎃"
		),
		new KowalskiFrontpageMessages(
			new DateTimeImmutable("11. November"),
			new DateTimeImmutable("21. February"),
			"Happy Carneval! 🥸"
		)
	];
