<?php

require_once('vendor/autoload.php');

use Carbon\Carbon;
use Citco\Carbon as CitcoCarbon;
use CarbonExt\FiscalYear\Calculator;

// Object Instantiation

$brisbane = new Carbon('2015-12-01', 'Australia/Brisbane');
$newYorkCity  = new Carbon('2015-12-01', 'America/New_York');
$dtBerlin = new Carbon('2015-12-01', 'Europe/Berlin');

$outputString = "Time difference between %s & %s: %s hours.\n";

// Date difference
printf(
    $outputString,
    "Berlin", "Brisbane, Australia",
    $dtBerlin->diffInHours($brisbane, false)
);
printf(
    $outputString,
    "Berlin", "New York City, America",
    $dtBerlin->diffInHours($newYorkCity, false)
);

$septEighteen2014 = Carbon::createFromDate(2014, 9, 18, $dtBerlin->getTimezone());

printf(
    "difference between now and %s in \n\thours: %d, \n\tdays: %d, \n\tweeks: %d, \n\tweekend days: %d, \n\tweek days: %s, \n\thuman readable: %s\n",
    $septEighteen2014->toFormattedDateString(),
    $dtBerlin->diffInHours($septEighteen2014),
    $dtBerlin->diffInDays($septEighteen2014),
    $dtBerlin->diffInWeeks($septEighteen2014),
    $dtBerlin->diffInWeekendDays($septEighteen2014),
    $dtBerlin->diffInWeekDays($septEighteen2014),
    $dtBerlin->diffForHumans($septEighteen2014)
);

// Date formatting
echo $dtBerlin->toDateString() . "\n";
echo $dtBerlin->toFormattedDateString() . "\n";
echo $dtBerlin->toTimeString() . "\n";
echo $dtBerlin->toDateTimeString() . "\n";
echo $dtBerlin->toDayDateTimeString() . "\n";
echo $dtBerlin->toRfc1036String() . "\n";
echo $dtBerlin->toAtomString() . "\n";
echo $dtBerlin->toCookieString() . "\n";
echo $dtBerlin->toRssString() . "\n";
$dtBerlin->setToStringFormat('l jS \\of F Y');
echo $dtBerlin . "\n";
echo (int)$dtBerlin->isLeapYear() . "\n";

// is* range of functions test
echo "Is yesterday? "
   . ($dtBerlin->isYesterday() ? "yes" : "no") . PHP_EOL;
echo "Is a Thursday? "
   . ($dtBerlin->isThursday() ? "yes" : "no") . PHP_EOL;
echo "Is in the future? "
   . ($dtBerlin->isFuture() ? "yes" : "no") . PHP_EOL;
echo "Is a leap year? "
   . ($dtBerlin->isLeapYear() ? "yes" : "no") . PHP_EOL;

// first and last of the month
echo "First of the month " . $dtBerlin->firstOfMonth() . PHP_EOL;
echo "Last of the month " . $dtBerlin->lastOfMonth() . PHP_EOL;

// nthOf* function test
echo "Start of the month ", $dtBerlin->startOfMonth() . PHP_EOL;
echo "End of the month ", $dtBerlin->endOfMonth() . PHP_EOL;
echo "End of the decade ", $dtBerlin->endOfDecade() . PHP_EOL;

// Date manipulation
echo $dtBerlin->addHours(5)->addDays(2)
         ->addWeeks(1)->addMonths(3) . PHP_EOL;
echo $dtBerlin->subMonths(8)->subHours(7) . PHP_EOL;

// Find UK Bank Holidays
$dtLondon = CitcoCarbon::today('Europe/London');
list($date, $name) = each($dtLondon->nextBankHoliday());
printf("The next bank holiday is %s on %s\n", $name, $date);

foreach($dtLondon->getBankHolidays([2016, 2017]) as $date => $name) {
    printf("The next bank holiday is %s on %s\n", $name, $date);
}

// Find end of the current financial year
$fyCalculator = new Calculator(7, 1); /* FY starts on July 1 */
print $fyCalculator->get($dtBerlin);

