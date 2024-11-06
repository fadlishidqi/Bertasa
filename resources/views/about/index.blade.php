<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - BERTASA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-pink-50 min-h-screen">
    @include('layouts.navbar')
    
    <div class="container mx-auto px-4 md:px-8 py-12">
        <div class="flex flex-col md:flex-row items-center gap-12 mb-24">
            <!-- Left Side - Image -->
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/about-illustration.png') }}" alt="Illustration" class="w-full">
            </div>

            <!-- Right Side - Text -->
            <div class="w-full md:w-1/2">
                <span class="bg-pink-500 text-white px-4 py-2 rounded-full text-sm">About us</span>
                
                <h1 class="text-4xl font-bold mt-6 mb-4">
                    Bahasa Tanpa Suara, Namun Penuh Makna Kenali Kami Lebih Dekat !
                </h1>
                
                <p class="text-gray-600">
                    Di situs ini, kami mengajak Anda untuk menjelajahi dunia komunikasi yang lebih 
                    inklusif. Dengan berbagai fitur dan materi yang kami sediakan, mari bersama-sama 
                    memahami dan menguasai bahasa isyarat yang memiliki kekuatan untuk menyatukan kita semua.
                </p>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mt-24">
            <h2 class="text-3xl font-bold text-center mb-12">
                Mengapa memilih BERTASA (Bersuara Tanpa Suara) ?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pembelajaran Interaktif</h3>
                    <p class="text-gray-600">
                        Belajar bahasa isyarat dengan metode yang menyenangkan
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Komunikasi Aktif</h3>
                    <p class="text-gray-600">
                        Bergabunglah dengan komunitas pembelajar yang saling mendukung
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Video Tutorial Lengkap</h3>
                    <p class="text-gray-600">
                        Akses ke berbagai video tutorial berkualitas
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>