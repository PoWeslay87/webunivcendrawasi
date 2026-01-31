@extends('layouts.frontend')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 py-24 overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="animate-float-slow absolute top-10 left-10 w-20 h-20 rounded-full bg-blue-400 opacity-10"></div>
        <div class="animate-float-medium absolute top-40 right-20 w-32 h-32 rounded-full bg-purple-400 opacity-10"></div>
        <div class="animate-float-fast absolute bottom-20 left-1/4 w-24 h-24 rounded-full bg-indigo-400 opacity-10"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-5xl font-bold text-white mb-6 opacity-0 animate-slide-down">
                Program Studi
            </h1>
            <p class="text-xl text-gray-200 leading-relaxed opacity-0 animate-slide-up">
                Pilih jalur pendidikan terbaik untuk masa depan cemerlang Anda di Universitas Cendrawasi Papua Tengah
            </p>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-white transform -skew-y-1"></div>
</div>

<style>
/* Slide Animations */
@keyframes slideDown {
    0% { opacity: 0; transform: translateY(-50px); }
    100% { opacity: 1; transform: translateY(0); }
}
@keyframes slideUp {
    0% { opacity: 0; transform: translateY(50px); }
    100% { opacity: 1; transform: translateY(0); }
}
/* Floating Animations */
@keyframes float-slow {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(20px, -20px) rotate(180deg); }
}
@keyframes float-medium {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(-15px, 15px) rotate(-180deg); }
}
@keyframes float-fast {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(10px, -10px) rotate(90deg); }
}
/* Animation Classes */
.animate-slide-down { animation: slideDown 1s ease-out forwards; }
.animate-slide-up { animation: slideUp 1s ease-out 0.3s forwards; }
.animate-float-slow { animation: float-slow 8s infinite ease-in-out; }
.animate-float-medium { animation: float-medium 6s infinite ease-in-out; }
.animate-float-fast { animation: float-fast 4s infinite ease-in-out; }
</style>

<!-- Content Section -->
<div class="py-20 bg-gradient-to-b from-blue-50 to-purple-50">
    <div class="container mx-auto px-6">

        @if ($data && $data->isNotEmpty())
            <!-- Grid Card -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($data as $program)
                    @php($ket = $program->keterangan ?? $program->deskripsi)
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl border border-gray-100 hover:border-blue-400 transition-all duration-500 p-8 flex flex-col"
                         data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        
                        <!-- Nama Program Studi -->
                        <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                            {{ $program->nama_program_studi }}
                        </h3>

                        <!-- Info -->
                        <div class="mt-4 text-base text-gray-600 space-y-2">
                            <p class="flex items-center">
                                <i class="fas fa-layer-group text-blue-500 mr-2"></i>
                                <span><strong>Jenjang:</strong> {{ $program->jenjang }}</span>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-university text-blue-500 mr-2"></i>
                                <span><strong>Fakultas:</strong> {{ $program->fakultas }}</span>
                            </p>
                        </div>

                        <!-- Deskripsi / Keterangan -->
                        <p class="mt-5 text-gray-700 text-lg leading-relaxed">
                            {{ $ket ?? 'Belum ada keterangan.' }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg text-lg text-center">
                Tidak ada data program studi.
            </div>
        @endif
    </div>
</div>

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>
@endsection
