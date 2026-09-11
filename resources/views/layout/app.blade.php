<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Point of Sales' }}</title>

    <!-- SEO Optimization -->
    <meta name="description" content="Spark Admin - Premium Bootstrap 5 Admin Dashboard Template">
    <meta name="author" content="Spark Admin Team">

    <!-- Favicon -->
    @include('inc.css')

</head>

<body>
    <!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green navigation
         ========================================== -->
    <div class="sidebar-wrapper" id="sidebar">
        <!-- Brand Logo / Identity -->
        <a href="index.html" class="sidebar-brand">
            <i class="bi bi-asterisk"></i>
            <span>POS | PPKD Jakarta Pusat</span>
        </a>

        <!-- Navigation Menu -->
        <div class="flex-grow-1 overflow-y-auto">
            <!-- Group: Menu -->
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Menu</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-link" id="menu-overview"
                            title="Overview">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <ul class="sidebar-menu-list">
                        <li class="sidebar-menu-item">
                            <a href="{{ route('admin.users.index') }}" class="sidebar-menu-link" id="menu-overview"
                                title="Overview">
                                <i class="bi bi-people-fill"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="sidebar-menu-list">
                        <li class="sidebar-menu-item">
                            <a href="{{ route('admin.categories.index') }}" class="sidebar-menu-link" id="menu-overview"
                                title="Overview">
                                <i class="bi bi-bookmarks-fill"></i>
                                <span>Item Category</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="sidebar-menu-list">
                        <li class="sidebar-menu-item">
                            <a href="{{ route('admin.products.index') }}" class="sidebar-menu-link" id="menu-overview"
                                title="Overview">
                                <i class="bi bi-fork-knife"></i>
                                <span>Products</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="sidebar-menu-list">
                        <li class="sidebar-menu-item">
                            <a href="{{ route('admin.orders.create') }}"  class="sidebar-menu-link" id="menu-overview" title="Overview">
                                <i class="bi bi-wallet-fill"></i>
                                <span>Order Transaction</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="sidebar-menu-list">
                        <li class="sidebar-menu-item">
                            <a href="{{ route('admin.roles.index') }}" class="sidebar-menu-link" id="menu-overview"
                                title="Overview">
                                <i class="bi bi-gear-fill"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>

        <!-- Sidebar Profile Card (Dynamic Footer) -->
        <div class="sidebar-profile">
            <img src="assets/images/avatar.png" alt="Administrator" class="sidebar-profile-img"
                onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
            <div class="sidebar-profile-info">
                <div class="sidebar-profile-name">Administrator</div>
                <div class="sidebar-profile-email">admin@email.com</div>
            </div>
        </div>
    </div>
    <!-- ==========================================
         END: Sidebar Component
         ========================================== -->
    <!-- START: Page Header Banner -->
    <!-- END: Page Header Banner -->

    <!-- ==========================================
         START: Main Content Area
         ========================================== -->
    <div class="main-wrapper">

        <!-- START: Top Navbar Component -->
        <header class="navbar-custom d-flex align-items-center justify-content-between w-100 px-3">

            <div class="navbar-left d-flex align-items-center">
                <!-- Desktop sidebar toggle (visible on large screens only) -->
                <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
                    id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
                    <i class="bi bi-chevron-bar-left"></i>
                </button>
                <!-- Mobile sidebar toggle -->
                <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
                    <i class="bi bi-list"></i>
                </button>
                {{-- 
                <!-- Quick Actions Dropdown -->
                <div class="dropdown ms-2">
                    <button class="btn-quick-action dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" id="quick-actions-dropdown">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-quick-action" aria-labelledby="quick-actions-dropdown">
                        <li class="dropdown-header">Quick Action Shortcuts</li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-plus"></i> New
                                Invoice</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-plus"></i> New User</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-seam"></i> New Product</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> System Settings</a>
                        </li>
                    </ul>
                </div> --}}
            </div>

            <!-- Mid navbar: search pill -->
            <div class="navbar-search-wrapper">
                {{-- <input type="text" class="navbar-search-input" placeholder="Search anything in Spark..."
                    id="main-search"> --}}
                {{-- <button class="navbar-search-btn" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button> --}}
            </div>

            <!-- Right actions -->
            <div class="navbar-actions d-flex align-items-center ms-auto">
                <!-- Fullscreen Toggle -->
                <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>
                <div class="dropdown">
                    <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" id="btn-notifications" data-bs-auto-close="outside">
                        <i class="bi bi-bell"></i>
                        <span class="navbar-action-badge"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0"
                        aria-labelledby="btn-notifications">
                        <div class="notification-header">
                            <h6 class="notification-title">Notifications</h6>
                            <button class="btn-clear-all" type="button">Mark all read</button>
                        </div>
                        <div class="notification-list">
                            <!-- Sale Notification -->
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-success text-white">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text">New sale received: <strong>$150.00</strong></p>
                                    <span class="notification-time">2 mins ago</span>
                                </div>
                                <span class="notification-unread-dot"></span>
                            </a>
                            <!-- User Registration Notification -->
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-primary text-white">
                                    <i class="bi bi-person-plus-fill"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text">New user registered: <strong>John Doe</strong></p>
                                    <span class="notification-time">1 hour ago</span>
                                </div>
                                <span class="notification-unread-dot"></span>
                            </a>
                            <!-- Low Stock Notification -->
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-warning text-dark">
                                    <i class="bi bi-box-seam-fill"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text">Stock running low: <strong>Hoodie</strong></p>
                                    <span class="notification-time">3 hours ago</span>
                                </div>
                            </a>
                        </div>
                        <a href="#" class="notification-footer">View All Notifications</a>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="dropdown ms-2">
                    <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" id="profile-dropdown">
                        <img src="assets/images/avatar.png" alt="Profile Image" class="navbar-profile-img">
                        <span class="navbar-profile-name d-none d-md-inline">Administrator</span>
                        <i class="bi bi-chevron-down navbar-profile-caret"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile"
                        aria-labelledby="profile-dropdown">
                        <li class="dropdown-header">Welcome !</li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> My Account</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-lock"></i> Lock Screen</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="page-login.html"><i
                                    class="bi bi-box-arrow-right"></i>
                                Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- END: Top Navbar Component -->

        <!-- START: Page Header Banner -->
        <div class="page-header">
            <div>
                <h1 class="page-title">{{ $title ?? '' }}</h1>
            </div>
        </div>
        <!-- END: Page Header Banner -->

        <!-- START: Blank Page Content Area -->
        <div>
            @yield('content')
        </div>
        <!-- END: Blank Page Content Area -->

        @include('inc.js')

</body>

</html>
