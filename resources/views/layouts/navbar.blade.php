<?php
/**
 * File:	/resources/views/layouts/navbar.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	January 31st, 2021 5:29pm
 * -----
 * Last Modified: 	November 5th 2022 12:30:41 pm
 * Modified By: 	Nicola Sergio <nicola.sergio@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2022-11-05	N. Sergio	    1.1 Fix: Set users/guest link for Smartbreak-logo
 * 2022-11-04	G. Giorgio	    1.1 Fix: Hide cart icon out of orders time-range
 * 2021-05-04   R. Andriano     Fix navbar for extra small device / added google avatar
 * 2021-04-12	G. Ciriello     Improvements
 * 2021-01-31	G. Ciriello     Various update on layout and views	
 * 2020-12-20	G. Ciriello	    First release
 * -----
 * 
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
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <!-- Sidebar menu Button -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <h6>
            {{-- Check about home page route--}}
            @auth
            <a href="{{ url('/home') }}" class="navbar-brand">
            @endauth

            @guest
            <a href="{{ url('/') }}" class="navbar-brand">
            @endguest
                <img class="d-none d-sm-inline" src="{{ asset('img/logos/logo.svg') }}" alt="SmartBreak logo" style="max-height: 35px; vertical-align: text-bottom;">
                <!-- Image on extra small screen -->
                <img  class="ml-2 d-sm-none" src="{{ asset('img/logos/logo.svg') }}" alt="SmartBreak logo" style="max-height: 21px;  vertical-align: text-bottom;">
            </a>
            <small class="text-muted d-none d-md-inline">{{ config('app.version') }}</small>
        </h6>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            @auth

            {{-- Visualizza il pulsante carrello e totale solo nel time-range --}}
            @timecheck
                @can('is-student')

                <li class="nav-item">
                    <a href="{{ route('cart.checkout') }}" class="nav-link text-dark">
                        🛒
                        <span class="badge badge-primary navbar-badge cart-num-items">0</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cart.checkout') }}" class="nav-link text-dark">
                        <span class="cart-total">{{ formatPrice(0) }}</span>
                    </a>
                </li>
                @endcan
            @endtimecheck

            <li class="nav-item d-none d-md-block">
                @if(auth()->user()->google_avatar != null)
                   <a class="nav-link text-dark">
                      <img width="28px" style="text-align: left;" src="{{auth()->user()->google_avatar}}" class="img-circle elevation-1" alt="User Image">
                    {{ auth()->user()->first_name }}
                    </a>
                @else
                    <a class="nav-link text-dark">👋 &nbsp;{{ auth()->user()->first_name }}</a>
                @endif
            </li>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <li class="nav-item d-none d-md-block">
                <a class="nav-link text-dark" href="javascript:;"
                   onclick="document.getElementById('logout-form').submit();">
                    Esci
                </a>
            </li>
            @endauth

        </ul>
    </div>
</nav>
