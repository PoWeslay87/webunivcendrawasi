<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
      .sidebar-link {
        display: flex; align-items: center;
        padding: .65rem 1rem;
        border-radius: .5rem;
        color: #374151; /* gray-700 */
        font-weight: 500;
      }
      .sidebar-link:hover {
        background-color: #d1fae5; /* green-100 */
        color: #065f46; /* green-800 */
      }
    </style>
  </head>
  <body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    <div class="flex min-h-screen">
      
      <!-- Sidebar -->
      <aside class="w-64 bg-white dark:bg-gray-800 shadow-md">
        <div class="p-4 text-xl font-bold text-green-600">
          Admin Panel
        </div>
        <nav class="mt-6 space-y-1">
          <a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
          <a href="{{ route('admin.users.index') }}" class="sidebar-link">👤 Users</a>
          <a href="{{ route('admin.roles.index') }}" class="sidebar-link">🛡 Roles</a>
          <a href="{{ route('admin.permissions.index') }}" class="sidebar-link">🔑 Permissions</a>
          <a href="{{ route('admin.posts.index') }}" class="sidebar-link">📝 Posts</a>
        </nav>
      </aside>

      <!-- Main Content -->
      <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between items-center">
          <h1 class="text-lg font-bold text-gray-700 dark:text-gray-100">@yield('title')</h1>
          <div class="flex items-center space-x-4">
            <button class="relative">
              🔔
              <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs rounded-full px-1">2</span>
            </button>
            <img src="https://i.pravatar.cc/40" class="w-9 h-9 rounded-full" alt="User">
          </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
          @yield('content')
        </main>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    {{-- Area untuk script halaman --}}
    @yield('scripts')
    @stack('scripts')
  </body>
</html>
