<!-- Footer Elegan -->
<footer class="bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- About Section -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-university text-2xl text-blue-400"></i>
                    <h3 class="text-xl font-bold">Universitas Papua City</h3>
                </div>
                <p class="text-gray-300 leading-relaxed">
                    Membangun generasi unggul dan berdaya saing global melalui pendidikan berkualitas dan inovatif.
                </p>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/p/HUMAS-Universitas-Cenderawasih-100057350355596/?locale=id_ID" class="text-gray-300 hover:text-blue-400 transform hover:scale-110 transition-all">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="https://www.instagram.com/universitas_cenderawasih/" class="text-gray-300 hover:text-pink-400 transform hover:scale-110 transition-all">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="https://x.com/ucenderawasih" class="text-gray-300 hover:text-sky-400 transform hover:scale-110 transition-all">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="https://www.youtube.com/@universitas-cenderawasih-live" class="text-gray-300 hover:text-red-500 transform hover:scale-110 transition-all">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold border-b border-blue-700 pb-2">Link Cepat</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route ('tentang.programstudi')}}" class="text-gray-300 hover:text-white hover:translate-x-2 transition-all inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-blue-400"></i>
                            Program Studi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white hover:translate-x-2 transition-all inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-blue-400"></i>
                            Pendaftaran
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white hover:translate-x-2 transition-all inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-blue-400"></i>
                            Beasiswa
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white hover:translate-x-2 transition-all inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-blue-400"></i>
                            Fasilitas
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold border-b border-blue-700 pb-2">Kontak</h3>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt mt-1 text-blue-400"></i>
                        <span class="text-gray-300">Jl. Cendrawasi papua City No. 123<br>Papua, indonesi</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-phone text-blue-400"></i>
                        <span class="text-gray-300">(+62) 123-4567</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-blue-400"></i>
                        <span class="text-gray-300">info@cendrawasi.ac.id</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold border-b border-blue-700 pb-2">Newsletter</h3>
                <p class="text-gray-300">Dapatkan informasi terbaru dari kami</p>
                <form class="space-y-2">
                    <input type="email" placeholder="Email Anda" 
                           class="w-full px-4 py-2 bg-blue-900/50 border border-blue-800 rounded-lg 
                                  focus:outline-none focus:border-blue-400 text-white placeholder-gray-400">
                    <button class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg 
                                 transition-colors text-white font-medium">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-blue-800/50">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} Universitas Cendrawasi Papua City. Semua hak dilindungi.
                </p> 
            </div>
        </div>
    </div>
</footer>