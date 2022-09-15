<?php
/**
 * File:	/resources/views/layouts/sidebar.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	December 15th, 2020 11:05pm
 * -----
 * Last Modified: 	February 18th 2022 11:00:00 am
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
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
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo - hide sidebar button-->
    <a data-widget="pushmenu" href="#" role="button" class="brand-link">
        <img src="{{ asset('img/logos/logo.svg') }}" alt="SmartBreak logo" style="max-width: 80%;">
        <i class="far fa-window-close"></i>
    </a>
    
    {{-- <span class="brand-text font-weight-light">AdminLTE 3</span> --}}
    
    <!-- Sidebar -->
    <div class="sidebar">
    @auth
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 mb-3 d-flex d-block d-md-none">
        
            @if(auth()->user()->google_avatar != null)
                <div class="image">
                    <img src="{{auth()->user()->google_avatar ?? ""}}" class="img-circle elevation-1" alt="User Image">
                </div>
                <div class="info ml-3">
                    {{ auth()->user()->first_name }}
                </div>            
            @else
                <div class="info ml-3">
                    👋 &nbsp;{{ auth()->user()->first_name }}
                </div>
            @endif
        </div>
    @endauth

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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-file-upload"></i>
                      <p>
                        Importa CSV
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                      <li class="nav-item">
                        <a href="{{ route('classes.import') }}" class="nav-link">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>
                                Classi
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('users.import') }}" class="nav-link">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>
                                Studenti
                            </p>
                        </a>
                      </li>
                    </ul>
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
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Prodotti
                        </p>
                    </a>
                </li>

                @can('is-manager')
                <li class="nav-item">
                    <a href="{{ route('products.stocks') }}" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Modifica giacenze
                        </p>
                    </a>
                </li>
                @endcan
                
                <li class="nav-item">
                    <hr>
                </li>
                @endcanany
                
                @can('is-manager')
                <li class="nav-item">
                    <a href="{{ route('orders.by-day') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Ordini per classe
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.by-day') }}" class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            Ordini per prodotto
                        </p>
                    </a>
                </li>
                @endcan

                @canany(['is-manager', 'is-admin'])
                <li class="nav-item">
                    <a href="{{ route('analytics') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Statistiche
                        </p>
                    </a>
                </li>


                @endcanany

                @can('is-student')
                
                <li class="nav-item">
                    <a href="{{ route('cart.choose-products') }} " class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            Fai un ordine
                        </p>
                    </a>
                </li>
                
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
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Ordini della mia classe
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('analytics') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Statistiche
                        </p>
                    </a>
                </li>

                @endcan
                <li class="nav-item">
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="javascript:;"  onclick="document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Esci
                        </p>
                    </a>
                </li>
                

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@push('js')
<script>
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>
@endpush
