<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bertasa | Belajar Bahasa Isyarat</title>
   @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 overflow-x-hidden">
   <!-- Navigation -->
   @include('layouts.navbar')

   <!-- Hero Section -->
   <div class="px-4 py-8">
       <div class="max-w-7xl mx-auto text-center">
           <h1 class="text-3xl font-bold mb-2">Asah Kemampuanmu,</h1>
           <h2 class="text-3xl font-bold mb-4">Buka Akses Baru untuk Berkomunikasi</h2>
           <p class="text-gray-600 mb-12">
               Pelajari dasar-dasar bahasa isyarat dan tingkatkan keterampilan komunikasi non-verbal Anda dengan panduan alfabet tangan ini. 
               Setiap huruf memiliki gerakan sederhana yang memudahkan Anda berinteraksi tanpa suara.
           </p>
       </div>

       <!-- Card Grid -->
       <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
           @foreach($bahasaIsyarat as $isyarat)
           <div class="bg-white rounded-lg">
               <div class="w-full h-64 flex items-center justify-center">
                   <img 
                       src="{{ Storage::url($isyarat->gambar) }}" 
                       alt="Huruf {{ $isyarat->huruf }}" 
                       class="max-w-full max-h-full object-contain"
                   >
               </div>
               <div class="p-6 bg-[#E31E54] text-white">
                   <h3 class="text-xl font-bold mb-2">Huruf {{ $isyarat->huruf }}</h3>
                   <p>{{ $isyarat->deskripsi }}</p>
               </div>
           </div>
           @endforeach
       </div>
   </div>

   <!-- Footer -->
   @include('layouts.footer')
</body>
</html>