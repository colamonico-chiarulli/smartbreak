<?php
/**
 * File:	/config/laravelpwa.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 12th, 2021 3:28pm
 * -----
 * Last Modified: 	March 27th, 2021 7:17pm
 * Modified By: 	Andriano Rino <andriano@colamonicochiarulli.edu.it>
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

return [
    'name' => 'SmartBreak',
    'manifest' => [
        'name' => 'SmartBreak',
        'short_name' => 'SmartBreak',
        'start_url' => '/',
        'background_color' => '#007bff',
        'theme_color' => '#007bff',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> '#007bff',
        'icons' => [
            '192x192' => [
                'path' => '/pwa-assets/manifest-icon-192.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/pwa-assets/manifest-icon-512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/pwa-assets/apple-splash-640x-136.jpg',
            '750x1334' => '/pwa-assets/apple-splash-750x-334.jpg',
            '828x1792' => '/pwa-assets/apple-splash-828x-792.jpg',
            '1125x2436' => '/pwa-assets/apple-splash-1125-2436.jpg',
            '1242x2208' => '/pwa-assets/apple-splash-1242-2208.jpg',
            '1242x2688' => '/pwa-assets/apple-splash-1242-2688.jpg',
            '1536x2048' => '/pwa-assets/apple-splash-1536-2048.jpg',
            '1668x2224' => '/pwa-assets/apple-splash-1668-2224.jpg',
            '1668x2388' => '/pwa-assets/apple-splash-1668-2388.jpg',
            '2048x2732' => '/pwa-assets/apple-splash-2048-2732.jpg',
        ],
        'shortcuts' => [
            /*
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
            */
        ],
        'custom' => []
    ]
];
