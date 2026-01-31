<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="google" content="notranslate">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Admin')</title>

  {{-- Bootstrap 5.3 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  @vite(['resources/js/app.js'])

  <style>
    body { background-color:#0b1220; }

    /* Sidebar */
    .sidebar {
      width: 250px;
      min-height: 100vh;
      background-color: #0d1b2a; /* biru tua */
      transition: width 0.3s;
    }
    .sidebar.collapsed { width: 70px; }
    .sidebar .brand {
      font-size: 1.2rem;
      font-weight: bold;
      color: #fff;
      padding: 1rem;
      white-space: nowrap;
    }
    .sidebar .nav-link {
      color: #9ca3af;
      border-radius: .4rem;
      display: flex;
      align-items: center;
      gap: .75rem;
      padding: .6rem 1rem;
      white-space: nowrap;
      transition: all 0.2s ease;
    }
    .sidebar .nav-link i { font-size: 1.1rem; }
    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
      background-color: #1b263b;
      color: #fff;
    }

    /* Hide text when collapsed */
    .sidebar.collapsed .nav-link span { display: none; }
    .sidebar.collapsed .brand span { display: none; }
    .sidebar.collapsed .nav-link { justify-content: center; }

    /* Content area */
    .content-wrap {
      flex: 1;
      padding: 1.5rem;
      transition: margin-left 0.3s;
    }

    /* Card */
    .card {
      background-color: #1e293b; 
      border: 1px solid #334155;
    }
    .card-header {
      background-color: #1b263b;
      color: #e2e8f0;
    }

    /* Table */
    .table-dark {
      background-color: #0d1b2a;
    }
    .table-dark th {
      background-color: #1b263b !important;
      color: #e2e8f0 !important;
    }
    .table-dark td {
      color: #f1f5f9;
    }

    /* Badges */
    .badge { font-size: .75rem; }
  </style>

  @stack('styles')
</head>
<body class="text-light">
  <div class="d-flex">
    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar p-2">
      <div class="d-flex justify-content-between align-items-center brand">
        <i class="bi bi-layers"></i> <span>Admin</span>
        <button class="btn btn-sm btn-dark border-0" id="toggleSidebar">
          <i class="bi bi-list"></i>
        </button>
      </div>
      <ul class="nav flex-column gap-1">
        <li>
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i><span>Dashboard</span>
          </a>
        </li>

        {{-- Pengguna & Akses --}}
        @canany(['users_view','roles_view','permissions_view'])
          <li>
            <a class="nav-link" data-bs-toggle="collapse" href="#submenu-ua">
              <i class="bi bi-people"></i><span>Pengguna & Akses</span>
            </a>
            <div class="collapse {{ request()->routeIs('admin.users.*','admin.roles.*','admin.permissions.*') ? 'show' : '' }}" id="submenu-ua">
              <ul class="nav flex-column ms-3">
                @can('users_view')
                  <li><a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-person"></i><span>Users</span>
                  </a></li>
                @endcan
                @can('roles_view')
                  <li><a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <i class="bi bi-shield-lock"></i><span>Roles</span>
                  </a></li>
                @endcan
                @can('permissions_view')
                  <li><a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                    <i class="bi bi-key"></i><span>Permissions</span>
                  </a></li>
                @endcan
              </ul>
            </div>
          </li>
        @endcanany

        {{-- Konten --}}
        @can('posts_view')
          <li>
            <a class="nav-link" data-bs-toggle="collapse" href="#submenu-konten">
              <i class="bi bi-journal-text"></i><span>Konten</span>
            </a>
            <div class="collapse {{ request()->routeIs('admin.posts.*') ? 'show' : '' }}" id="submenu-konten">
              <ul class="nav flex-column ms-3">
                <li><a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                  <i class="bi bi-file-earmark-text"></i><span>Posts</span>
                </a></li>
              </ul>
            </div>
          </li>
        @endcan

        {{-- Akademik --}}
        @canany(['prodi_view','akre_view'])
          <li>
            <a class="nav-link" data-bs-toggle="collapse" href="#submenu-akad">
              <i class="bi bi-mortarboard"></i><span>Akademik</span>
            </a>
            <div class="collapse {{ request()->routeIs('admin.program-studi.*','admin.akreditasi.*') ? 'show' : '' }}" id="submenu-akad">
              <ul class="nav flex-column ms-3">
                @can('prodi_view')
                  <li><a href="{{ route('admin.program-studi.index') }}" class="nav-link {{ request()->routeIs('admin.program-studi.*') ? 'active' : '' }}">
                    <i class="bi bi-journal"></i><span>Program Studi</span>
                  </a></li>
                @endcan
                @can('akre_view')
                  <li><a href="{{ route('admin.akreditasi.index') }}" class="nav-link {{ request()->routeIs('admin.akreditasi.*') ? 'active' : '' }}">
                    <i class="bi bi-patch-check"></i><span>Akreditasi</span>
                  </a></li>
                @endcan
              </ul>
            </div>
          </li>
        @endcanany

        {{-- Profil Kampus --}}
        @canany(['univ_view','univ_edit','univ_create'])
          <li>
            <a class="nav-link" data-bs-toggle="collapse" href="#submenu-profil">
              <i class="bi bi-building"></i><span>Profil Kampus</span>
            </a>
            <div class="collapse {{ request()->routeIs('admin.papua-universitas.*') ? 'show' : '' }}" id="submenu-profil">
              <ul class="nav flex-column ms-3">
                <li><a href="{{ route('admin.papua-universitas.index') }}" class="nav-link {{ request()->routeIs('admin.papua-universitas.*') ? 'active' : '' }}">
                  <i class="bi bi-info-circle"></i><span>Sejarah Visi Misi</span>
                </a></li>
              </ul>
            </div>
          </li>
        @endcanany

        {{-- Site Stats --}}
        @if (Route::has('admin.site-stats.index'))
          @canany(['stats_view','stats_edit','stats_create'])
            <li>
              <a href="{{ route('admin.site-stats.index') }}" class="nav-link {{ request()->routeIs('admin.site-stats.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i><span>Site Stats</span>
              </a>
            </li>
          @endcanany
        @endif

        {{-- Kontak --}}
        @can('kontak_view')
          <li>
            <a href="{{ route('admin.kontak.index') }}" class="nav-link {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
              <i class="bi bi-envelope"></i><span>Kontak</span>
              @if(($kontakCount ?? 0) > 0)
                <span class="badge bg-danger ms-1">{{ $kontakCount }}</span>
              @endif
            </a>
          </li>
        @endcan
      </ul>
    </aside>

    <!-- MAIN -->
    <div class="content-wrap">
      <div class="d-flex justify-content-end mb-3">
        @auth
          <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
              @if (Route::has('profile.edit'))
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                  <i class="bi bi-gear me-2"></i>Profile
                </a></li>
                <li><hr class="dropdown-divider"></li>
              @endif
              <li>
                <form method="POST" action="{{ route('logout') }}">@csrf
                  <button class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Log Out</button>
                </form>
              </li>
            </ul>
          </div>
        @endauth
      </div>

      @includeWhen(session('success') || session('error'), 'layouts.flash')
      @yield('content')
    </div>
  </div>

  {{-- JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('toggleSidebar').addEventListener('click', function(){
      document.getElementById('sidebar').classList.toggle('collapsed');
    });
  </script>
  @stack('scripts')
</body>
</html>
