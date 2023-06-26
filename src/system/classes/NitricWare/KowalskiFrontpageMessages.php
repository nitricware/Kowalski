<?php
	
	namespace NitricWare;
	
	use DateTimeImmutable;
	
	class KowalskiFrontpageMessages {
		public function __construct (
			public DateTimeImmutable $startTime,
			public DateTimeImmutable $endTime,
			public string $message = "",
		) {
			$thisYear = new DateTimeImmutable("31. December");
			$now = new DateTimeImmutable();
			$nextYear = (int) $thisYear->format("Y") + 1;
			$lastYear = (int) $thisYear->format("Y") - 1;
			$currentDayOfYear = (int) $now->format("z");
			
			if ($this->endTime->getTimestamp() < $this->startTime->getTimestamp()) {
				/*
				 * $endTime is before $startDate. Since those parameters are entered as
				 * yearless date strings, DateTimeImmutable places them in the same year.
				 * The intention by the entering person is like to stretch beyond new year.
				 * So the dates must be corrected.
				 *
				 * start - now - end
				 * 1.10    1.2   1.3    year change between start and now - move start back a year      start > now     start DoY > now DoY
				 * 1.10    1.11  1.2    year change between now and end - move end ahead a year         now > end       now DoY > end DoY < now DoY
				 * 1.10    1.4   1.2    year change already happened
				 */
				
				if ((int)$this->startTime->format("z") > $currentDayOfYear) {
					$this->startTime = new DateTimeImmutable($this->startTime->format("j. F $lastYear"));
					return;
				}
				
				if ((int)$this->endTime->format("z") < $currentDayOfYear) {
					$this->endTime = new DateTimeImmutable($this->endTime->format("j. F $nextYear"));
				}
			}
		}
	}