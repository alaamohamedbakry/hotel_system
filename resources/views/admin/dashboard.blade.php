<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pagetitle')</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- bootstrab css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    @stack('stylesheets')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <!-- Navbar -->
        <nav class="shadow main-header navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i> MyWebsite
                </a>

                <!-- Toggler for mobile view -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar content -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Left Links -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            @if (auth('web')->check())
                                <a class="nav-link active" href="{{ route('admin_index') }}">Home</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>

                    <!-- Right Content -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Search -->
                        <li class="nav-item">
                            <form class="form-inline d-flex">
                                <input class="form-control form-control-sm me-2" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-outline-secondary btn-sm" type="submit">Search</button>
                            </form>
                        </li>

                        <!-- Messages Dropdown -->
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-comments"></i>
                                <span class="badge bg-danger">{{ $messages_reviews_count }}</span>
                                <!-- عرض عدد المراجعات -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="messagesDropdown">
                                @if ($messages_reviews->count() > 0)
                                    <!-- تحقق إذا كانت هناك مراجعات -->
                                    @foreach ($messages_reviews as $review)
                                        <li><a class="dropdown-item"
                                                href="#">{{ $review->name }}:{{ $review->message }}</a></li>
                                        <!-- عرض الرسالة -->
                                    @endforeach
                                @else
                                    <li><a class="dropdown-item" href="#">No messages</a></li>
                                @endif
                            </ul>
                        </li>


                        <!-- Notifications Dropdown -->
                        <li class="nav-item dropdown ms-2">
                            @if (auth('web')->check())
                                <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="far fa-bell"></i>
                                    @if ($ms > 0)
                                        <span class="badge bg-warning">{{ $ms }}</span>
                                    @endif
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                                    <li><a class="dropdown-item" href="{{ route('guests.show.tables') }}">New Guests:
                                            {{ $registrations }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('booking.index') }}">New Bookings
                                            Today: {{ $bookings }}</a></li>
                                </ul>
                            @endif
                        </li>



                        <!-- User Dropdown -->
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i>
                                @if (Auth::guard('staff')->check())
                                    <!-- Staff is logged in -->
                                    {{ Auth::guard('staff')->user()->name }}
                                @elseif(Auth::check())
                                    <!-- Admin or other web user is logged in -->
                                    {{ Auth::user()->name }}
                                @else
                                    Guest
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if (Auth::guard('staff')->check())
                                    <!-- This is the Staff -->
                                    <li><a class="dropdown-item" href="{{ route('staff.dashboard') }}">Staff
                                            Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('staff.profile.edit') }}">Profile</a>
                                    </li>
                                    <li>
                                        <!-- Staff logout link with GET method -->
                                        <a href="{{ route('staff.logout') }}" class="dropdown-item">Log Out</a>
                                    </li>
                                @elseif(Auth::check())
                                    <!-- This is the Admin -->
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin
                                            Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li>
                                        <!-- Admin logout form using POST -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Log Out</button>
                                        </form>
                                    </li>
                                @else
                                    <!-- Guest -->
                                    <p>You are not logged in</p>
                                @endif
                            </ul>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="pb-3 mt-3 mb-3 user-panel d-flex">
                    <div class="image">
                        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        @if ($authUser)
                            <a href="#" class="d-block">
                                @if ($authUser)
                                    {{ isset($authUser->First_name) ? trim(($authUser->First_name ?? '') . ' ' . ($authUser->Last_name ?? '')) : $authUser->name }}
                                @else
                                    Guest
                                @endif
                            </a>
                        @else
                            <a href="#" class="d-block">Guest</a>
                        @endif
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-hotel"></i>
                                <p>
                                    {{ __('HotelManagementSystem') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin_index') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard </p>
                                    </a>
                                </li>
                            </ul>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Forms
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth('web')->check())
                                    <li class="nav-item">
                                        <a href="{{ route('roomtype.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Room type form</p>
                                        </a>
                                        <a href="{{ route('rooms.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Room form</p>
                                        </a>
                                        <a href="{{ route('hotel.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Hotel form</p>
                                        </a>
                                        <a href="{{ route('roles.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Role form</p>
                                        </a>
                                        <a href="{{ route('staff.form') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Staff form</p>
                                        </a>
                                    </li>
                                @endif

                                @if (auth('web')->check() || auth('staff')->check())
                                    <li class="nav-item">
                                        <a href="{{ route('booking_admin.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Booking form</p>
                                        </a>
                                        <a href="{{ route('guest.create') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Guest form</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth('web')->check() || auth('staff')->check())
                                    <li class="nav-item">
                                        <a href="{{ route('rooms.show.tables') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('Room tables') }}</p>
                                        </a>
                                    </li>
                                @endif

                                @if (auth('web')->check())
                                    <li class="nav-item">
                                        <a href="{{ route('hotel.show.tables') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('Hotel tables') }}</p>
                                        </a>
                                        <a href="{{ route('roomtype.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('RoomType Index') }}</p>
                                        </a>
                                        <a href="{{ route('roles.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('Roles tables') }}</p>
                                        </a>
                                        <a href="{{ route('staff.show_tables') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('Staff tables') }}</p>
                                        </a>
                                    </li>
                                @endif

                                @if (auth('web')->check() || auth('staff')->check())
                                    <li class="nav-item">
                                        <a href="{{ route('booking.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('Booking Tables') }}</p>
                                        </a>
                                        <a href="{{ route('guests.show.tables') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('Guest tables') }}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>

                        <li class="nav-header">EXAMPLES</li>
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/gallery.html" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Gallery
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/kanban.html" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Kanban Board
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Mailbox
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('inbox') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inbox</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Pages
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/examples/invoice.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Invoice</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/profile.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/contact-us.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contact us</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Extras
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Login & Register v1
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="pages/examples/login.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Login v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/register.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Register v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/forgot-password.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Forgot Password v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/recover-password.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Recover Password v1</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Login & Register v2
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="pages/examples/login-v2.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Login v2</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/register-v2.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Register v2</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Forgot Password v2</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Recover Password v2</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/lockscreen.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lockscreen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Legacy User Menu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/language-menu.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Language Menu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/404.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Error 404</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/500.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Error 500</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/pace.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pace</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/blank.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Blank Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="starter.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Starter Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-search"></i>
                                <p>
                                    Search
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/search/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Search</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/search/enhanced.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Enhanced</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">MISCELLANEOUS</li>
                        <li class="nav-item">
                            <a href="iframe.html" class="nav-link">
                                <i class="nav-icon fas fa-ellipsis-h"></i>
                                <p>Tabbed IFrame Plugin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Documentation</p>
                            </a>
                        </li>
                        <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Level 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Level 1
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Level 2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Level 2
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Level 2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Level 1</p>
                            </a>
                        </li>
                        <li class="nav-header">LABELS</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Important</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Warning</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-info"></i>
                                <p>Informational</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->



            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="mb-2 row">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
                <div class="main-container">
                    <div class="pd-ltr-20 xs-pd-20-10">
                        <div class="min-height-200px">
                            <div class="bg-white pd-20 border-radius-4 box-shadow mb-30">
                                @yield('cont')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.content-header -->


            <!-- /.content -->


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- Summernote -->
        <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
        <!-- bootstrab js-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jquery js-->
        <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <!-- jquery css-->
        <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
        @stack('scripts')
</body>
<style>
    .navbar {
        font-size: 14px;
    }

    .navbar .dropdown-menu {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar .form-control {
        max-width: 200px;
    }

    .navbar .badge {
        font-size: 12px;
    }
</style>

</html>
