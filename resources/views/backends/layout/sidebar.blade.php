<aside class="main-sidebar elevation-4 sidebar-dark-primary" style="width: 280px">
    <!-- Brand Logo -->
    {{-- <a href="{{ route('dashboard') }}" class="brand-link">
    <img src="{{ asset('uploads/business_logo/' . session('business_logo')) }}" alt="AdminLTE Logo" class="brand-image" style="width: 100%;
      object-fit: contain;margin-left: 0; height: 200px;max-height: 100px;">
    </a> --}}
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('uploads/all_photo/library-logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="width: 60%;
      object-fit: contain;margin-left: 35px ; height: 200px;max-height: 100px;">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ Session::get('current_user')->profiles }}" class="img-circle elevation-2"
                alt="User Image"> --}}
            </div>
            <div class="info">
                {{-- <a href="#" class="d-block">{{ Session::get('current_user')->name }}</a> --}}
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-3 width-nav">
            <ul class="nav nav-pills nav-sidebar flex-column" id="sidebar-menu" data-widget="treeview" role="menu" data-accordion="true">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (auth()->user()->can('view.dash'))
                <li class="nav-item" id="menu_dashboard">
                    {{-- menu-open --}}
                    <a href="{{ route('home') }}" class="nav-link custom-ml" id="menu_dashboard_bg">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->can('view.user'))
                <li class="nav-item @if(Route::is('role.*')||Route::is('add_role*')||Route::is('edit_role*')||Route::is('user.*')) menu-open @endif" id="menu_employee_mg">
                    {{-- menu-open --}}
                    <a href="#" class="nav-link custom-ml" id="menu_employee_bg">
                        <i class="nav-icon fas fa-book-open-reader"></i>
                        <p>Librarain Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" id="collapse_employee">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link custom-ml @if(Route::is('user.index')) active @endif" id="menu_employess">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link custom-ml @if(Route::is('role.index')) active @endif" id="menu_employess">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('view.customer'))
                <li class="nav-item @if(Route::is('customer_type.*')||Route::is('customer.*')) menu-open @endif" id="menu_employee_mg">
                    {{-- menu-open --}}
                    <a href="#" class="nav-link custom-ml" id="menu_employee_bg">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Customer
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" id="collapse_employee">
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}" class="nav-link custom-ml @if(Route::is('customer.index')) active @endif" id="menu_employess">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer_type.index') }}" class="nav-link custom-ml @if(Route::is('customer_type.index')) active @endif" id="menu_employess">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>Customer Type</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (auth()->user()->can('view.catelog'))
                <li class="nav-item @if(Route::is('catelog.*')||Route::is('book.*')) menu-open @endif" id="menu_employee_mg">
                    {{-- menu-open --}}
                    <a href="#" class="nav-link custom-ml" id="menu_employee_bg">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>Catelogs & Books
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" id="collapse_employee">
                        @if (auth()->user()->can('view.book'))
                        <li class="nav-item">
                            <a href="{{ route('book.index') }}" class="nav-link custom-ml @if(Route::is('book.index')) active @endif" id="menu_employess">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>Book</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('catelog.index') }}" class="nav-link custom-ml @if(Route::is('catelog.index')) active @endif" id="menu_employess">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>Catelog</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-item" id="menu_employee_mg">
                    {{-- menu-open --}}
                    <a href="#" class="nav-link custom-ml" id="menu_employee_bg">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Brrow
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" id="collapse_employee">
                        <li class="nav-item">
                            <a href="{{ route('book.index') }}" class="nav-link custom-ml @if(Route::is('book.index')) active @endif" id="menu_employess">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>Book</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('catelog.index') }}" class="nav-link custom-ml @if(Route::is('catelog.index')) active @endif" id="menu_employess">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>Catelog</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->can('view.setting'))
                <li class="nav-item" id="menu_setting">
                    {{-- menu-open --}}
                    <a href="#" class="nav-link custom-ml" id="menu_setting_bg">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" id="collapse_setting">
                        <li class="nav-item">
                            <a href="" class="nav-link custom-ml">
                                <i class="fa-solid fa-plus nav-icon"></i>
                                <p>Business Setting</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
