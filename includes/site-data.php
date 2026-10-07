<?php
// Public opening hours, aligned with the supplied September 2026 menu.
// The table and Schema.org metadata both use this single source.
$openingSchedule = [
  ['Maandag', 'Monday', '09:00', '00:00'],
  ['Dinsdag', 'Tuesday', '09:00', '00:00'],
  ['Woensdag', 'Wednesday', '09:00', '00:00'],
  ['Donderdag', 'Thursday', '09:00', '00:00'],
  ['Vrijdag', 'Friday', '09:00', '02:00'],
  ['Zaterdag', 'Saturday', '10:00', '02:00'],
  ['Zondag', 'Sunday', '10:00', '00:00'],
];
$hours = array_map(static function ($day) {
  return [$day[0], $day[2] . '–' . $day[3]];
}, $openingSchedule);
$openingHoursSpecification = array_map(static function ($day) {
  return [
    '@type' => 'OpeningHoursSpecification',
    'dayOfWeek' => $day[1],
    'opens' => $day[2],
    'closes' => $day[3],
  ];
}, $openingSchedule);
