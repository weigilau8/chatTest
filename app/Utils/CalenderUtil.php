<?php
/**
 * Created by PhpStorm.
 * User: fukum
 * Date: 2018/06/08
 * Time: 17:27
 */

namespace App\Utils;

// API
define("CALENDAR_URL", "japanese__ja@holiday.calendar.google.com");
//define("CALENDAR_URL", "japanese@holiday.calendar.google.com");
//define("CALENDAR_URL", "outid3el0qkcrsuf89fltf7a4qbacgt9@import.calendar.google.com");

// TimeZone
ini_set("date.timezone", "Asia/Tokyo");

class CalenderUtil {

	public static function getGoogleHoliday($s_date, $e_date) {

		$holidays_url = sprintf(
				'https://www.googleapis.com/calendar/v3/calendars/%s/events?' .
				'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
				CALENDAR_URL,
				env('GOOGLE_API_KEY'),
				$s_date->format('Y-m-d') . 'T00:00:00Z',
				$e_date->format('Y-m-d') . 'T00:00:00Z',
				50
		);

		$holidays = array();
		if ($results = file_get_contents($holidays_url, true)) {
			$results = json_decode($results);
			foreach ($results->items as $item) {
				$date = strtotime((string)$item->start->date);
				$title = (string)$item->summary;
				$holidays[date('Y-m-d', $date)] = $title;
			}
			ksort($holidays);
		}

		return $holidays;
	}
}