{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('title','Dashboard')

@push('styles')
<style>
  /* Shadow & hover lembut */
  .shadow-soft { box-shadow: 0 10px 30px rgba(2,8,23,.06); }
  .card-metric {
    border: 0; border-radius: 1rem; color: #fff;
    background-image: linear-gradient(135deg, rgba(255,255,255,.08), rgba(0,0,0,.08));
    backdrop-filter: blur(2px);
  }
  .metric-icon {
    width:3rem;height:3rem;border-radius:9999px;
    display:flex;align-items:center;justify-content:center;
    background: rgba(255,255,255,.15);
  }
  /* List item transparan tapi tetap terbaca */
  .list-transparent .list-group-item{
    background: transparent;
    border-color: rgba(148,163,184,.25);
  }
  .text-truncate-240{ max-width: 240px; }
  .text-truncate-200{ max-width: 200px; }
  /* Chart container fixed height */
  .chart-wrap{ position: relative; height: 300px; }
</style>
@endpush

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="display-6 mb-0">Dashboard Admin</h1>
  </div>

  {{-- METRICS --}}
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="card card-metric bg-primary shadow-soft">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="small text-uppercase opacity-75">Users</div>
            <div class="fs-2 fw-bold">{{ $metrics['users'] }}</div>
          </div>
          <div class="metric-icon"><i class="bi bi-people fs-4"></i></div>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-3">
      <div class="card card-metric bg-success shadow-soft">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="small text-uppercase opacity-75">Roles</div>
            <div class="fs-2 fw-bold">{{ $metrics['roles'] }}</div>
          </div>
          <div class="metric-icon"><i class="bi bi-shield-lock fs-4"></i></div>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-3">
      {{-- pakai teks gelap supaya kontras di bg-warning --}}
      <div class="card shadow-soft" style="background:#f59e0b; border:0; border-radius:1rem; color:#111827;">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="small text-uppercase opacity-75 text-white">Permissions</div>
            <div class="fs-2 fw-bold text-white">{{ $metrics['permissions'] }}</div>
          </div>
          <div class="metric-icon" style="background: rgba(255, 255, 255, 0.1); color:#ffffff;"><i class="bi bi-key fs-4"></i></div>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card card-metric bg-info text-white shadow-soft">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="small text-uppercase opacity-75">Posts</div>
            <div class="fs-2 fw-bold">{{ $metrics['posts'] }}</div>
          </div>
          <div class="metric-icon"><i class="bi bi-journal-text fs-4"></i></div>
        </div>
      </div>
    </div>
  </div>

  {{-- QUICK ACTIONS --}}
  <div class="card mb-4 shadow-soft">
    <div class="card-body">
      <div class="d-flex flex-wrap gap-2">
        @can('posts_create')
          <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-1"></i> New Post
          </a>
        @endcan
        @can('users_create')
          <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-person-plus me-1"></i> New User
          </a>
        @endcan
        @can('roles_create')
          <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-outline-success">
            <i class="bi bi-shield-plus me-1"></i> New Role
          </a>
        @endcan
        @can('permissions_view')
          <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-sliders me-1"></i> Manage Permissions
          </a>
        @endcan
      </div>
    </div>
  </div>

  <div class="row g-4">
    {{-- CHART: Posts per Bulan --}}
    <div class="col-lg-6">
      <div class="card shadow-soft h-100">
        <div class="card-header bg-transparent fw-semibold">Posts per Bulan</div>
        <div class="card-body">
          <div class="chart-wrap">
            <canvas id="chartPosts"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- CHART: Permission per Modul --}}
    <div class="col-lg-6">
      <div class="card shadow-soft h-100">
        <div class="card-header bg-transparent fw-semibold">Permissions per Modul</div>
        <div class="card-body">
          <div class="chart-wrap">
            <canvas id="chartPerm"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4 mt-1">
    {{-- CHART: Top Roles --}}
    <div class="col-lg-6">
      <div class="card shadow-soft h-100">
        <div class="card-header bg-transparent fw-semibold">Top Roles by Users</div>
        <div class="card-body">
          <div class="chart-wrap">
            <canvas id="chartRoles"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- Recent lists --}}
    <div class="col-lg-6">
      <div class="card shadow-soft h-100">
        <div class="card-header bg-transparent fw-semibold">Aktivitas Terbaru</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h6 class="text-uppercase text-secondary">Posts</h6>
              <ul class="list-group list-group-flush list-transparent">
                @forelse($recentPosts as $p)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="me-2 text-truncate text-truncate-240">{{ $p->judul }}</span>
                    <small class="text-secondary">{{ optional($p->created_at)->format('d M') }}</small>
                  </li>
                @empty
                  <li class="list-group-item text-secondary">Belum ada.</li>
                @endforelse
              </ul>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
              <h6 class="text-uppercase text-secondary">Inbox</h6>
              <ul class="list-group list-group-flush list-transparent">
                @forelse($recentInbox as $m)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="me-2 text-truncate text-truncate-200">{{ $m->nama }}</span>
                    <small class="text-secondary">{{ optional($m->created_at)->format('d M') }}</small>
                  </li>
                @empty
                  <li class="list-group-item text-secondary">Belum ada.</li>
                @endforelse
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{-- Chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
  <script>
    // Palet warna enak dilihat (Bootstrap-ish)
    const palette = {
      primary:  'rgba(13,110,253,0.9)',
      primary50:'rgba(13,110,253,0.15)',
      success:  'rgba(25,135,84,0.9)',
      success50:'rgba(25,135,84,0.15)',
      warning:  'rgba(255,193,7,0.9)',
      warning50:'rgba(255,193,7,0.2)',
      info:     'rgba(13,202,240,0.9)',
      info50:   'rgba(13,202,240,0.15)',
      gray:     'rgba(108,117,125,0.9)',
      gray20:   'rgba(108,117,125,0.2)',
    };

    // Default chart options
    const baseOpts = {
      responsive: true,
      maintainAspectRatio: false,
      interaction: { mode: 'index', intersect: false },
      plugins: {
        legend: { display: false },
        tooltip: { backgroundColor: 'rgba(15,23,42,.95)' }
      },
      scales: {
        y: { grid: { color: 'rgba(148,163,184,.2)' }, ticks:{ precision:0 } },
        x: { grid: { display: false } }
      }
    };

    // Line: posts per month
    new Chart(document.getElementById('chartPosts'), {
      type: 'line',
      data: {
        labels: @json($postLabels),
        datasets: [{
          label: 'Posts',
          data: @json($postSeries),
          fill: true,
          borderColor: palette.primary,
          backgroundColor: palette.primary50,
          tension: .35,
          pointRadius: 3,
          pointHoverRadius: 5
        }]
      },
      options: baseOpts
    });

    // Bar: permissions per module
    const permLabels = @json($permByModule->keys()->values());
    const permValues = @json($permByModule->values());
    new Chart(document.getElementById('chartPerm'), {
      type: 'bar',
      data: {
        labels: permLabels,
        datasets: [{
          label: 'Permissions',
          data: permValues,
          backgroundColor: palette.info,
          borderColor: palette.info,
          borderWidth: 1,
          borderRadius: 6
        }]
      },
      options: {
        ...baseOpts,
        plugins: { legend: { display: false } }
      }
    });

    // Doughnut: top roles by users
    const roleLabels = @json($rolesTop->pluck('name'));
    const roleValues = @json($rolesTop->pluck('users_count'));

    // generate warna berbeda untuk tiap slice
    const doughnutColors = roleLabels.map((_, i) => {
      const base = [palette.primary, palette.success, palette.warning, palette.info, palette.gray];
      return base[i % base.length];
    });

    new Chart(document.getElementById('chartRoles'), {
      type: 'doughnut',
      data: {
        labels: roleLabels,
        datasets: [{
          data: roleValues,
          backgroundColor: doughnutColors,
          borderColor: '#fff',
          borderWidth: 2,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
      }
    });
  </script>
@endpush
