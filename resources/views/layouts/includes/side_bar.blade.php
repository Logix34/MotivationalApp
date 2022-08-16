
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Motivation <sup>App</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
        <a class="nav-link " href="{{url('dashboard')}}">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages  Menu -->
    <li class="nav-item {{Request::is('users') ? 'active' : ''}} ">
        <a class="nav-link "  href="{{url('users')}}">
            <i class="fa-solid fa-users"></i>
            <span>Users</span></a>
    </li>
    <li class="nav-item {{Request::is('categories') ? 'active' : ''}} ">
        <a class="nav-link "  href="{{url('categories')}}">
            <i class="fa-solid fa-list"></i>
            <span>Category</span></a>
    </li>
    <li class="nav-item {{Request::is('sub_categories') ? 'active' : ''}} ">
        <a class="nav-link "  href="{{url('sub_categories')}}">
            <i class="fa-brands fa-accusoft"></i>
            <span>SubCategories</span></a>
    </li>
    <li class="nav-item {{Request::is('themes') ? 'active' : ''}} ">
        <a class="nav-link "  href="{{url('themes')}}">
            <i class="fas fa-images"></i>
            <span>Themes</span></a>
    </li>
    <li class="nav-item {{Request::is('collections') ? 'active' : ''}} ">
        <a class="nav-link "  href="{{url('collections')}}">
            <i class="fa-solid fa-record-vinyl"></i>
            <span>Collections</span></a>
    </li>

    <li class="nav-item {{Request::is('quotes') ? 'active' : ''}} ">
        <a class="nav-link "  href="{{url('quotes')}}">
            <i class="fas fa-feather-alt"></i>
            <span>Quotes</span></a>
    </li>
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->


{{--////////////////////////////////////////////////......Main Top Bar Content............///////////////////////////////////////--}}
