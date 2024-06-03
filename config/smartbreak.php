<?php
/**
 * File:	/config/smartbreak.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Tuesday, April 12th 2021, 12:39:38 pm
 * -----
 * Last Modified: 	June 3rd 2024 11:48:15 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2024-06-03	R. Andriano	    1.3 Added school config
 * 2023-11-26	R. Andriano	    1.2 Added check ENV for max_units_ordable
 * 2022-10-20	R. Andriano     1.1 Added check ENV for FROM-TO order-time-range
 * 2021-04-12	G. Ciriello	    First release 
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
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2022".
 * 
 * ------------------------------------------------------------------------------
 */

?>

<?php
$default_privacy = config('app.url').'/privacy';

return [
    'school_name' => env('SCHOOL_NAME', "IISS Colamonico Chiarulli"),
    'school_address' => env('SCHOOL_ADDRESS', "Via C. Colamonico, n. 5"),
    'school_city' => env('SCHOOL_CITY', "Acquaviva delle Fonti (BA)"),
    'school_country' => env('SCHOOL_COUNTRY', "Italia"),
    'school_url' => env('SCHOOL_URL', "https://colamonicochiarulli.edu.it"),
    'school_url_privacy' => env('SCHOOL_URL_PRIVACY', $default_privacy),
    'school_url_facebook' => env('SCHOOL_URL_FACEBOOK', "https://www.facebook.com/IISS-Colamonico-Chiarulli-625046681002397"),
    'school_url_instagram' => env('SCHOOL_URL_INSTAGRAM', "https://www.instagram.com/istitutocolamonicochiarulli/"),
    'school_url_youtube' => env('SCHOOL_URL_YOUTUBE', "https://www.youtube.com/c/IISSCColamonicoNChiarulliAcquavivadelleFonti"),

    // Max items orderable for each product
    'max_units_ordable' => env('MAX_UNITS_ORDABLE', 3),

    'security_token' => env('SECURITY_CRON_TOKEN', 'afeff6005ab6ad9cd32b0b38492fcfd2'),

    'orders_timerange' => [
        'enabled' => env('ORDERS_TIMERANGE_CHECK_ENABLED', true),
        // example: orders allowed between 7:00 and 9:10
        'from' => env('ORDERS_TIMERANGE_CHECK_FROM',"07:00:00"),
        'to' => env('ORDERS_TIMERANGE_CHECK_TO', "09:10:00"),
    ]
];
