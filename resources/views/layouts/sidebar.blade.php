<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
       <img src="{{ asset('img/logos/logo.svg') }}" alt="" style="max-height: 35px;">
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               @can('is-manager')
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            Prodotti
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Categorie
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

                @endcan

                @can('is-student')



                @endcan


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
