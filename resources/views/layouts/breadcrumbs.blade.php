@props(['items' => []])

<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb bg-transparent m-0">
    @foreach ($items as $i => $item)
      @php
        $isLast = $i === count($items) - 1;
        $label  = $item['label'] ?? '';
        $url    = $item['url']   ?? null;
      @endphp

      @if($isLast || empty($url))
        <li class="breadcrumb-item active text-white-50" aria-current="page">{{ $label }}</li>
      @else
        <li class="breadcrumb-item">
          <a href="{{ $url }}" class="link-light text-decoration-none">{{ $label }}</a>
        </li>
      @endif
    @endforeach
  </ol>
</nav>

<style>
  /* kecilkan jarak biar pas dengan tema dark */
  .breadcrumb { padding: .25rem 0; }
</style>
