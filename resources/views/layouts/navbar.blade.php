<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-800 shadow-lg">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Logo -->
      <div class="flex-shrink-0 flex items-center text-white font-extrabold text-lg">
        <i class="fas fa-university mr-2"></i> Universitas Cenderawasi
      </div>

      <!-- Desktop menu -->
      <div class="hidden md:flex items-center space-x-6">
        {{-- Beranda --}}
        <a href="{{ url('/') }}"
           class="px-2 py-1 rounded {{ request()->is('/') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
          <i class="fas fa-home mr-1"></i> Beranda
        </a>

        {{-- Program Studi (route tersendiri) --}}
        <a href="{{ route('tentang.programstudi') }}"
           class="px-2 py-1 rounded {{ request()->routeIs('tentang.programstudi') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
          <i class="fas fa-graduation-cap mr-1"></i> Program Studi
        </a>

        {{-- Dropdown Tentang (AKTIF hanya utk: sejarah, visi_misi, akreditasi) --}}
        @php
          $tentangActive = request()->routeIs([
            'tentang.sejarah',
            'tentang.visi_misi',
            'tentang.akreditasi',
          ]);
        @endphp
        <div class="relative group">
          <button class="px-2 py-1 rounded flex items-center {{ $tentangActive ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
            🏛️ Tentang Universitas ▾
          </button>
          <ul class="absolute left-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-out bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-800 text-white rounded-md shadow-md mt-2 w-56 py-2">
            <li>
              <a href="{{ route('tentang.sejarah') }}"
                 class="block px-4 py-2 {{ request()->routeIs('tentang.sejarah') ? 'text-yellow-300 font-bold' : 'hover:text-yellow-300' }}">
                <i class="fas fa-scroll mr-1"></i> Sejarah Kampus
              </a>
            </li>
            <li>
              <a href="{{ route('tentang.visi_misi') }}"
                 class="block px-4 py-2 {{ request()->routeIs('tentang.visi_misi') ? 'text-yellow-300 font-bold' : 'hover:text-yellow-300' }}">
                <i class="fas fa-bullseye mr-1"></i> Visi & Misi
              </a>
            </li>
            <li>
              <a href="{{ route('tentang.akreditasi') }}"
                 class="block px-4 py-2 {{ request()->routeIs('tentang.akreditasi') ? 'text-yellow-300 font-bold' : 'hover:text-yellow-300' }}">
                <i class="fas fa-certificate mr-1"></i> Akreditasi
              </a>
            </li>
          </ul>
        </div>

        {{-- Kontak --}}
        <a href="{{ route('kontak.create') }}"
           class="px-2 py-1 rounded {{ request()->routeIs('kontak.create') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
          <i class="fas fa-envelope mr-1"></i> Kontak
        </a>

        {{-- Auth --}}
        @auth
          <a href="{{ route('dashboard') }}"
             class="px-2 py-1 rounded {{ request()->routeIs('admin.*') ? 'text-green-300 font-bold' : 'text-green-300 hover:text-white' }}">
            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
          </a>
        @else
          <a href="{{ route('login') }}"
             class="px-2 py-1 rounded {{ request()->routeIs('login') ? 'text-yellow-300 font-bold' : 'text-yellow-300 hover:text-white' }}">
            <i class="fas fa-sign-in-alt mr-1"></i> Login
          </a>
        @endauth
      </div>

      <!-- Mobile button -->
      <div class="flex items-center md:hidden">
        <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                class="text-white hover:text-yellow-300 focus:outline-none">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="md:hidden hidden px-4 pb-4 space-y-2 bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-800">
    <a href="{{ url('/') }}" class="block {{ request()->is('/') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
      <i class="fas fa-home mr-1"></i> Beranda
    </a>

    <a href="{{ route('tentang.programstudi') }}" class="block {{ request()->routeIs('tentang.programstudi') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
      <i class="fas fa-graduation-cap mr-1"></i> Program Studi
    </a>

    {{-- Dropdown Mobile (aktif hanya utk 3 route itu) --}}
    @php
      $tentangActiveMobile = request()->routeIs(['tentang.sejarah','tentang.visi_misi','tentang.akreditasi']);
    @endphp
    <div>
      <button onclick="toggleMobileDropdown()"
              class="w-full flex justify-between items-center {{ $tentangActiveMobile ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
        🏛️ Tentang Universitas 
        <span id="dropdownArrow" class="transform transition-transform">▾</span>
      </button>
      <div id="mobileDropdown" class="hidden pl-4 space-y-1">
        <a href="{{ route('tentang.sejarah') }}" class="block {{ request()->routeIs('tentang.sejarah') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
          <i class="fas fa-scroll mr-1"></i> Sejarah Kampus
        </a>
        <a href="{{ route('tentang.visi_misi') }}" class="block {{ request()->routeIs('tentang.visi_misi') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
          <i class="fas fa-bullseye mr-1"></i> Visi & Misi
        </a>
        <a href="{{ route('tentang.akreditasi') }}" class="block {{ request()->routeIs('tentang.akreditasi') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
          <i class="fas fa-certificate mr-1"></i> Akreditasi
        </a>
      </div>
    </div>

    <a href="{{ route('kontak.create')}}" class="block {{ request()->routeIs('kontak.create') ? 'text-yellow-300 font-bold' : 'text-white hover:text-yellow-300' }}">
      <i class="fas fa-envelope mr-1"></i> Kontak
    </a>

    @auth
      <a href="{{ route('admin.dashboard') }}" class="block {{ request()->routeIs('admin.*') ? 'text-green-300 font-bold' : 'text-green-300 hover:text-white' }}">
        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
      </a>
    @endauth

    @guest
      <a href="{{ route('login') }}" class="block {{ request()->routeIs('login') ? 'text-yellow-300 font-bold' : 'text-yellow-300 hover:text-white' }}">
        <i class="fas fa-sign-in-alt mr-1"></i> Login
      </a>
    @endguest
  </div>
</nav>

<script>
function toggleMobileDropdown() {
  const dropdown = document.getElementById('mobileDropdown');
  const arrow = document.getElementById('dropdownArrow');
  const isHidden = dropdown.classList.contains('hidden');
  dropdown.classList.toggle('hidden');
  arrow.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
}
</script>
