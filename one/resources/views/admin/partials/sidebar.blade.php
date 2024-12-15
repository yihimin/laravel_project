<ul class="navbar-nav bg-gradient-coffee sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-coffee"></i>
        </div>
    </a>


    <!-- Heading -->
    <div class="sidebar-heading">관리자 메뉴</div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>사용자 관리</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.products.index') }}">
            <i class="fas fa-fw fa-mug-hot"></i>
            <span>제품 관리</span>
        </a>
    </li>

    <!-- Nav Item - Settings -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.stats.index') }}">
            <i class="fas fa-fw fa-tools"></i>
            <span>통계 관리</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<style>
    .bg-gradient-coffee {
        background: linear-gradient(180deg, #b38b6d, #5c3d2e);
        color: #f8f5f2;
    }

    .navbar-nav .nav-link {
        color: #f8f5f2;
        font-weight: 500;
    }

    .navbar-nav .nav-link:hover {
        background-color: #755f48;
        color: #ffffff;
    }

    .sidebar-divider {
        border-color: #d4c0af;
    }

    .sidebar-brand {
        color: #f8f5f2;
        font-family: 'Cormorant Garamond', serif;
    }

    .sidebar-brand-icon {
        color: #f8f5f2;
    }
</style>
