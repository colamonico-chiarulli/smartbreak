<?php
/**
 * File:	/app/Helpers/helpers.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 14th, 2021 5:49pm
 * -----
 * Last Modified: 	November 10th 2024 7:16:21 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2024-11-01   R. Andriano     1.4 Added ENV WORKING_DAYS & CUSTOM_HOLIDAYS
 * 2022-11-15	R. Andriano	    New: Helper function isOrderTime()
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application 
 * developed during the PON course "The AppFactory" 2020-2021 with teachers 
 * & students of "Informatica e Telecomunicazioni" 
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 * 
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along 
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices 
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2021".
 * 
 * ------------------------------------------------------------------------------
 */

?>
<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

function formatPrice($amount)
{
    return number_format($amount, 2, ',', '.').' €';
}
/**
 * formatShortDate
 *
 * @param date $date
 * @return string day-Month
 */
function formatShortDate($date)
{
    return
        $date instanceof Carbon ?
        $date->format('d/m/Y') :
        Carbon::parse($date)->translatedFormat('d-M');
}

/**
 * formatDate
 *
 * @param date $date
 * @return string dd-mm-aa
 */
function formatDate($date)
{
    return
        $date instanceof Carbon ?
        $date->format('d/m/Y') :
        Carbon::parse($date)->format('d/m/Y');
}

/**
 * isOrderTime
 * 
 * Check if current time is valid for orders based on:
 * 1. Basic enablement check
 * 2. Working days check
 * 3. Holidays check (both Italian and custom, including holiday periods)
 * 4. Time range check
 *
 * @return boolean
 */
function isOrderTime(): bool
{
    $time_range = config('smartbreak.orders_timerange');
    
    if (!$time_range['enabled']) {
        return true;
    }

    $now = Carbon::now();
    
    return isWorkingDay($now, $time_range['working_days']) &&
           !isHoliday($now, $time_range['custom_holidays']) &&
           !isItalianHoliday($now) &&
           isWithinTimeRange($now, $time_range['from'], $time_range['to']);
}

/**
 * Check if the given date is a working day
 *
 * @param Carbon $date
 * @param array $workingDays
 * @return bool
 */
function isWorkingDay(Carbon $date, array $workingDays): bool
{
    return in_array($date->dayOfWeek, $workingDays);
}

/**
 * Check if the given date falls within the specified time range
 *
 * @param Carbon $date
 * @param string $fromTime
 * @param string $toTime
 * @return bool
 */
function isWithinTimeRange(Carbon $date, string $fromTime, string $toTime): bool
{
    $current_time = $date->toTimeString();
    return $current_time >= $fromTime && $current_time <= $toTime;
}

/**
 * Check if the given date is a custom holiday
 *
 * @param Carbon $date
 * @param array $customHolidays
 * @return bool
 */
function isHoliday(Carbon $date, array $customHolidays): bool
{
    foreach ($customHolidays as $holiday) {
        if (isDateInHoliday($date, $holiday)) {
            return true;
        }
    }
    return false;
}

/**
 * Check if a date falls within a single holiday or holiday period
 *
 * @param Carbon $date
 * @param string $holiday
 * @return bool
 */
function isDateInHoliday(Carbon $date, string $holiday): bool
{
    try {
        if (str_contains($holiday, '::')) {
            return isDateInHolidayPeriod($date, $holiday);
        }
        
        $holiday_date = Carbon::createFromFormat('d-m-Y', $holiday);
        return $date->isSameDay($holiday_date);
    } catch (Exception $e) {
        Log::warning("Invalid holiday format: {$holiday}", ['error' => $e->getMessage()]);
        return false;
    }
}

/**
 * Check if a date falls within a holiday period
 *
 * @param Carbon $date
 * @param string $holidayPeriod
 * @return bool
 */
function isDateInHolidayPeriod(Carbon $date, string $holidayPeriod): bool
{
    try {
        list($start_date, $end_date) = explode('::', $holidayPeriod);
        $start = Carbon::createFromFormat('d-m-Y', $start_date)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y', $end_date)->endOfDay();
        
        return $date->between($start, $end);
    } catch (Exception $e) {
        Log::warning("Invalid holiday period format: {$holidayPeriod}", ['error' => $e->getMessage()]);
        return false;
    }
}

/**
 * Check if the given date is an Italian holiday
 *
 * @param Carbon $date
 * @return bool
 */
function isItalianHoliday(Carbon $date): bool
{
    $italian_holidays = getItalianHolidays($date);
    
    foreach ($italian_holidays as $holiday) {
        if ($date->isSameDay($holiday)) {
            return true;
        }
    }
    return false;
}

/**
 * Get the list of Italian holidays for the given year
 *
 * @param Carbon $date
 * @return array
 */
function getItalianHolidays(Carbon $date): array
{
// Calcolo della Pasqua
$easterSunday = Carbon::create(date("Y-M-d", easter_date($date->year)));
$easterMonday = $easterSunday->copy()->addDay();

    return [
        // Fixed dates
        Carbon::create($date->year, 1, 1),    // Capodanno
        Carbon::create($date->year, 1, 6),    // Epifania
        Carbon::create($date->year, 4, 25),   // Liberazione
        Carbon::create($date->year, 5, 1),    // Festa del Lavoro
        Carbon::create($date->year, 6, 2),    // Repubblica
        Carbon::create($date->year, 8, 15),   // Ferragosto
        Carbon::create($date->year, 11, 1),   // Tutti i Santi
        Carbon::create($date->year, 12, 8),   // Immacolata
        Carbon::create($date->year, 12, 25),  // Natale
        Carbon::create($date->year, 12, 26),  // Santo Stefano
        $easterSunday,                        //Pasqua
        $easterMonday,                        //Lunedì dell'Angelo
    ];
}
