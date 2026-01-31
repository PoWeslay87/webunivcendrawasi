<!-- resources/views/frontend/kontak/form.blade.php -->
@extends('layouts.frontend')

@section('content')
<!-- Contact Section with Animation -->
<div class="relative bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 py-24 min-h-screen">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="animate-float-slow absolute top-10 left-10 w-20 h-20 rounded-full bg-blue-400 opacity-10"></div>
        <div class="animate-float-medium absolute top-40 right-20 w-32 h-32 rounded-full bg-purple-400 opacity-10"></div>
        <div class="animate-float-fast absolute bottom-20 left-1/4 w-24 h-24 rounded-full bg-indigo-400 opacity-10"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-up">
            <div class="md:flex">
                <!-- Info Section -->
                <div class="bg-gradient-to-r from-blue-800 to-purple-800 p-12 md:w-2/5">
                    <h2 class="text-3xl font-bold text-white mb-6 animate-fade-right">Hubungi Kami</h2>
                    <p class="text-gray-200 mb-8 animate-fade-right" style="animation-delay: 0.2s">
                        Kami siap membantu anda dengan pertanyaan dan informasi yang anda butuhkan
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start text-gray-200 animate-fade-right" style="animation-delay: 0.3s">
                            <i class="fas fa-map-marker-alt mt-1.5 mr-4"></i>
                            <span>Jl. Papua City No. 123, Papua, Indonesia</span>
                        </div>
                        <div class="flex items-center text-gray-200 animate-fade-right" style="animation-delay: 0.4s">
                            <i class="fas fa-phone mr-4"></i>
                            <span>+62 123-456-789</span>
                        </div>
                        <div class="flex items-center text-gray-200 animate-fade-right" style="animation-delay: 0.5s">
                            <i class="fas fa-envelope mr-4"></i>
                            <span>info@papuacity.ac.id</span>
                        </div>
                    </div>

                    <div class="mt-12 flex space-x-4">
                        <a href="#" class="text-white hover:text-gray-200 transform hover:scale-125 transition-transform">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                        <a href="#" class="text-white hover:text-gray-200 transform hover:scale-125 transition-transform">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                        <a href="#" class="text-white hover:text-gray-200 transform hover:scale-125 transition-transform">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="p-12 md:w-3/5 bg-gradient-to-br from-blue-900/95 via-indigo-900/95 to-purple-900/95 backdrop-blur-sm">
                    @if (session('success'))
                    <div id="successAlert" class="bg-green-500/20 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg animate-fade-in" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-green-200">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('kontak.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="relative animate-fade-up group" style="animation-delay: 0.4s">
                            <input type="text" name="nama" required
                                class="peer w-full px-4 py-3 rounded-lg border-2 border-blue-400/30 
                                       text-blue-200 focus:border-blue-400 focus:outline-none 
                                       bg-blue-900/50 backdrop-blur-sm transition-all placeholder-blue-300/50
                                       hover:border-blue-400/50"
                                placeholder="Masukkan nama lengkap">
                            <label class="absolute left-2 -top-2.5 px-2 bg-blue-900 text-sm text-blue-300 
                                         transition-all peer-placeholder-shown:top-3 
                                         peer-placeholder-shown:left-4 peer-focus:-top-2.5 
                                         peer-focus:left-2 peer-focus:text-blue-400">Nama</label>
                        </div>

                        <div class="relative animate-fade-up group" style="animation-delay: 0.5s">
                            <input type="email" name="email" required
                                class="peer w-full px-4 py-3 rounded-lg border-2 border-blue-400/30 
                                       text-white focus:border-blue-400 focus:outline-none 
                                       bg-white/10 backdrop-blur-sm transition-all placeholder-blue-300/50
                                       hover:border-blue-400/50"
                                placeholder="Masukkan email">
                            <label class="absolute left-2 -top-2.5 px-2 bg-blue-900 text-sm text-blue-300 
                                         transition-all peer-placeholder-shown:top-3 
                                         peer-placeholder-shown:left-4 peer-focus:-top-2.5 
                                         peer-focus:left-2 peer-focus:text-blue-400">Email</label>
                        </div>

                        <div class="relative animate-fade-up group" style="animation-delay: 0.6s">
                            <input type="text" name="subjek" required
                                class="peer w-full px-4 py-3 rounded-lg border-2 border-blue-400/30 
                                       text-white focus:border-blue-400 focus:outline-none 
                                       bg-white/10 backdrop-blur-sm transition-all placeholder-blue-300/50
                                       hover:border-blue-400/50"
                                placeholder="Masukkan subjek">
                            <label class="absolute left-2 -top-2.5 px-2 bg-blue-900 text-sm text-blue-300 
                                         transition-all peer-placeholder-shown:top-3 
                                         peer-placeholder-shown:left-4 peer-focus:-top-2.5 
                                         peer-focus:left-2 peer-focus:text-blue-400">Subjek</label>
                        </div>

                        <div class="relative animate-fade-up group" style="animation-delay: 0.7s">
                            <textarea name="pesan" rows="4" required
                                class="peer w-full px-4 py-3 rounded-lg border-2 border-blue-400/30 
                                       text-white focus:border-blue-400 focus:outline-none 
                                       bg-white/10 backdrop-blur-sm transition-all placeholder-blue-300/50
                                       hover:border-blue-400/50 resize-none"
                                placeholder="Tulis pesan anda"></textarea>
                            <label class="absolute left-2 -top-2.5 px-2 bg-blue-900 text-sm text-blue-300 
                                         transition-all peer-placeholder-shown:top-3 
                                         peer-placeholder-shown:left-4 peer-focus:-top-2.5 
                                         peer-focus:left-2 peer-focus:text-blue-400">Pesan</label>
                        </div>

                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-500 to-purple-500 text-white 
                                       py-4 px-6 rounded-lg hover:from-blue-600 hover:to-purple-600 
                                       focus:outline-none focus:ring-2 focus:ring-blue-400 
                                       focus:ring-opacity-50 transform hover:-translate-y-0.5 
                                       transition-all animate-fade-up shadow-lg hover:shadow-xl 
                                       hover:shadow-blue-500/20 border border-blue-400/30"
                                style="animation-delay: 0.8s">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add these styles to your existing styles or in a new style tag -->
<style>
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeRight {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

.animate-fade-up {
    animation: fadeUp 0.6s ease-out forwards;
    opacity: 0;
}

.animate-fade-right {
    animation: fadeRight 0.6s ease-out forwards;
    opacity: 0;
}

.animate-float-slow {
    animation: float 8s infinite ease-in-out;
}

.animate-float-medium {
    animation: float 6s infinite ease-in-out;
}

.animate-float-fast {
    animation: float 4s infinite ease-in-out;
}

/* Add smooth hover transitions */
.transform {
    transition: all 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}
</style>

<!-- Add this script at the bottom of your view -->
<script>
    // Auto dismiss success message after 5 seconds
    if (document.getElementById('successAlert')) {
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            alert.style.transition = 'all 0.5s ease-out';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    }
</script>
@endsection