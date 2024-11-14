<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bertasa | Belajar Bahasa Isyarat</title>
   @vite(['resources/css/app.css', 'resources/css/scrollhidden.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 overflow-x-hidden">
   <!-- Navigation -->
   @include('layouts.navbar')

   <!-- Hero Section -->
   <div class="px-4 py-8">
       <div class="max-w-6xl mx-auto text-center">
           <h1 class="text-4xl font-bold tracking-tight mb-2">Asah Kemampuanmu,</h1>
           <h2 class="text-4xl font-bold tracking-tight mb-6">Buka Akses Baru untuk Berkomunikasi</h2>
           <p class="text-gray-600 mb-16 max-w-3xl mx-auto text-lg">
               Pelajari dasar-dasar bahasa isyarat dan tingkatkan keterampilan komunikasi non-verbal Anda dengan panduan alfabet tangan ini. 
               Setiap huruf memiliki gerakan sederhana yang memudahkan Anda berinteraksi tanpa suara.
           </p>
       </div>

       <!-- Card Grid -->
       <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
           @foreach($bahasaIsyarat as $isyarat)
           <div class="bg-white rounded-2xl shadow-sm overflow-hidden h-full flex flex-col">
               <div class="relative w-full pt-[75%] bg-gray-50">
                   <div class="absolute inset-0 flex items-center justify-center p-8">
                       <img 
                           src="{{ Storage::url($isyarat->gambar) }}" 
                           alt="Huruf {{ $isyarat->huruf }}" 
                           class="max-w-full max-h-full object-contain"
                       >
                   </div>
               </div>
               <div class="p-6 bg-[#E31E54] text-white flex-1 flex flex-col">
                   <h3 class="text-2xl font-semibold mb-3">Huruf {{ $isyarat->huruf }}</h3>
                   <p class="leading-relaxed text-base flex-1">{{ $isyarat->deskripsi }}</p>
               </div>
           </div>
           @endforeach
       </div>
   </div>

   <!-- Footer -->
   @include('layouts.footer')
</body>
</html>
