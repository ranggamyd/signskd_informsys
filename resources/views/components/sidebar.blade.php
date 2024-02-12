<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/" class="h5">
                <img src="{{ asset('img/logo-1.png') }}" height="35">
                {{-- Sign-SKD --}}
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">SKD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Master Data</li>
            <li class="{{ Request::is('patient') ? 'active' : '' }}">
                <a class="nav-link" href="/patient">
                    <i class="fas fa-procedures"></i> <span>Kelola Pasien</span>
                </a>
            </li>
            <li class="{{ Request::is('skd') ? 'active' : '' }}">
                <a class="nav-link" href="/skd">
                    <i class="fas fa-envelope-open-text"></i> <span>Registrasi SKD</span>
                </a>
            </li>
            <li class="{{ Request::is('signed_skd') ? 'active' : '' }}">
                <a class="nav-link" href="/signed_skd">
                    <i class="fas fa-qrcode"></i> <span>Signed SKD</span>
                </a>
            </li>
            <li class="{{ Request::is('doctor') ? 'active' : '' }}">
                <a class="nav-link" href="/doctor">
                    <i class="fas fa-user-md"></i> <span>Kelola Dokter</span>
                </a>
            </li>
            <li class="menu-header">Additionals</li>
            <li class="{{ Request::is('user') ? 'active' : '' }}">
                <a class="nav-link" href="/user">
                    <i class="fas fa-users-cog"></i> <span>Kelola User</span>
                </a>
            </li>
            <li class="{{ Request::is('user/{id}') ? 'active' : '' }}">
                <a class="nav-link" href="/user/1">
                    <i class="far fa-address-card"></i> <span>Profil Saya</span>
                </a>
            </li>
            <li class="{{ Request::is('user/{id}/edit') ? 'active' : '' }}">
                <a class="nav-link" href="/user/1/edit">
                    <i class="fas fa-cog"></i> <span>Update Profil</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="/logout">
                    <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
                </a>
            </li>
    </aside>
</div>
