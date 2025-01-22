<!-- resources/views/about/index.blade.php  -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BERTASA - About</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/scrollhidden.css', 'resources/css/flipcard.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-50 min-h-screen">
    @include('layouts.navbar')
    
    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row items-center gap-10 mb-20">
            <!-- Left Side - Image -->
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/orangbanyak.png') }}" alt="Illustration" class="w-full h-auto">
            </div>
    
            <!-- Right Side - Text -->
            <div class="w-full md:w-1/2 flex flex-col justify-center">
                <div class="inline-block">
                    <span class="bg-pink-700 text-white px-4 py-2 rounded-full text-xl font-medium">
                        About us
                    </span>
                </div>
                
                <h1 class="text-4xl font-bold text-gray-900 mt-10 mb-10 leading-tight">
                    Bahasa Tanpa Suara, Namun Penuh Makna. Kenali Kami Lebih Dekat !
                </h1>
                
                <p class="text-gray-600 text-base leading-relaxed">
                    Di situs ini, kami mengajak Anda untuk menjelajahi dunia komunikasi yang lebih 
                    inklusif. Dengan berbagai fitur dan materi yang kami sediakan, mari bersama-sama 
                    memahami dan menguasai bahasa isyarat yang memiliki kekuatan untuk menyatukan kita semua.
                </p>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                Mengapa memilih BERTASA (Bersuara Tanpa Suara) ?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front shadow-lg">
                            <div class="flex flex-col items-center text-center h-full justify-center">
                                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <!-- Ukuran icon dikurangi -->
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <h3 class="text-lg font-bold mb-2">Pembelajaran Interaktif</h3>
                                <p class="text-gray-600 text-sm">
                                    Belajar bahasa isyarat dengan metode yang menyenangkan
                                </p>
                            </div>
                        </div>
                        <div class="flip-card-back shadow-lg">
                            <div>
                                <h3 class="text-lg font-bold mb-2">Pembelajaran Interaktif</h3>
                                <p class="text-sm">Nikmati pengalaman belajar yang menarik dengan materi interaktif dan latihan praktis</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front shadow-lg">
                            <div class="flex flex-col items-center text-center h-full justify-center">
                                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <h3 class="text-lg font-bold mb-2">Komunikasi Aktif</h3>
                                <p class="text-gray-600 text-sm">
                                    Bergabunglah dengan komunitas pembelajar yang saling mendukung
                                </p>
                            </div>
                        </div>
                        <div class="flip-card-back shadow-lg">
                            <div>
                                <h3 class="text-lg font-bold mb-2">Komunikasi Aktif</h3>
                                <p class="text-sm">Terhubung dengan komunitas yang aktif dan saling mendukung dalam perjalanan belajar Anda</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front shadow-lg">
                            <div class="flex flex-col items-center text-center h-full justify-center">
                                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <h3 class="text-lg font-bold mb-2">Video Tutorial Lengkap</h3>
                                <p class="text-gray-600 text-sm">
                                    Akses ke berbagai video tutorial yang berkualitas
                                </p>
                            </div>
                        </div>
                        <div class="flip-card-back shadow-lg">
                            <div>
                                <h3 class="text-lg font-bold mb-2">Video Tutorial Lengkap</h3>
                                <p class="text-sm">Pelajari bahasa isyarat melalui video tutorial berkualitas tinggi yang mudah diikuti</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        document.querySelectorAll('.flip-card').forEach(card => {
            card.addEventListener('click', () => {
                card.classList.toggle('flipped');
            });
        });
    </script>
</body>
</html>