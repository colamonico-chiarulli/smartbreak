<?php
/**
 * File:	/resources/views/layouts/sidebar.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	December 15th, 2020 11:05pm
 * -----
 * Last Modified: 	March 27th, 2021 1:09pm
 * Modified By: 	Andriano Rino <andriano@colamonicochiarulli.it>
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
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.it - 2021".
 * 
 * ------------------------------------------------------------------------------
 */

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo - hide sidebar button-->
    <a data-widget="pushmenu" href="#" role="button" class="brand-link">
        <img src="{{ asset('img/logos/logo.svg') }}" alt="SmartBreak logo" style="max-width: 80%;">
        {{-- <span class="brand-text font-weight-light">AdminLTE 3</span> --}}
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> --}}

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                @can('is-admin')
                <li class="nav-item">
                    <a href="{{ route('sites.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Sedi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('classes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Classi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Utenti
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('students.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Studenti
                        </p>
                    </a>
                </li>

                @endcan

                @canany(['is-manager', 'is-admin'])

                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Categorie
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            Prodotti
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            Ordini
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orders.by-day') }}" class="nav-link">
                                <p>
                                    Per classe
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.by-day') }}" class="nav-link">
                                <p>
                                    Per prodotto
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                @endcanany

                @can('is-student')

                <li class="nav-item">
                    <a href="{{ route('orders.by-student') }} " class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            I miei ordini
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('orders.today-by-class') }}" class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            Ordine della mia classe
                        </p>
                    </a>
                </li>

                @endcan
                <li class="nav-item">
                    <hr>
                </li>
                
                <li class="nav-item">
                <a data-widget="pushmenu" href="#" role="button" class="nav-link">
                    <i class="nav-icon fas fa-window-close"></i>
                    <p>Chiudi</p>
                </a>
            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>