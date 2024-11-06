<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BERTASA - Bahasa Tangan Komunikasi Nyata</title>
   @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-white to-pink-50 min-h-screen">
   @include('layouts.navbar')
   
   <main class="max-w-4xl mx-auto px-4 py-8">
       <div class="text-center mb-8">
           <div class="flex justify-center gap-1 mb-6">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                   <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
               </svg>
           </div>

           <h1 class="text-3xl font-bold mb-2">Bahasa Tangan, Komunikasi Nyata</h1>
           <h2 class="text-2xl font-bold mb-4">Jelajahi <span class="bg-pink-500 text-white px-2 py-1 rounded">BERTASA</span></h2>
           <p class="text-gray-600 max-w-2xl mx-auto mb-8">
               BERTASA hadir sebagai jembatan komunikasi nyata. Dengan panduan dan informasi,
               kami siap membantu menjadikan bahasa isyarat lebih mudah dipelajari dan dimengerti oleh semua orang
           </p>

           <div class="max-w-md mx-auto">
               <!-- Error Message -->
               @if (session('error'))
                   <div class="mt-4 p-4 bg-red-100 text-red-800 rounded">
                       {{ session('error') }}
                   </div>
               @endif

               <form action="{{ route('process-image') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                   @csrf
                   <div class="space-y-4">
                       <!-- Preview Image Container -->
                       <div class="mt-2" id="imagePreviewContainer" style="display: none;">
                           <img id="imagePreview" class="max-w-sm rounded border shadow-sm mx-auto" 
                               style="max-height: 300px; object-fit: contain;">
                       </div>

                       <!-- Upload Box -->
                       <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 hover:border-pink-500 transition-colors">
                           <div class="text-center">
                               <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                   <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                               </svg>
                               <input type="file" 
                                   name="image" 
                                   id="imageInput"
                                   accept="image/*" 
                                   class="hidden"
                                   onchange="previewImage(this)">
                               <label for="imageInput" class="cursor-pointer">
                                   <p class="mt-1 text-sm text-gray-600">Letakkan gambar di sini</p>
                                   <p class="mt-1 text-xs text-gray-500">Ukuran file maksimum: 5 MB</p>
                               </label>
                           </div>
                       </div>

                       <button type="submit" 
                               class="w-full bg-pink-500 text-white py-2 px-4 rounded-md hover:bg-pink-600 transition-colors">
                           Detect Sign
                       </button>
                   </div>
               </form>

               <!-- Loading Indicator -->
               <div id="loadingIndicator" class="hidden mt-4">
                   <div class="flex items-center justify-center">
                       <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-pink-500"></div>
                       <span class="ml-2">Processing...</span>
                   </div>
               </div>

               <!-- Hasil Prediksi -->
               @if (session('prediction'))
                   <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                       <h2 class="text-2xl font-bold mb-4">Hasil Prediksi Huruf</h2>
                       <div class="flex justify-center items-center gap-8">
                           <!-- Gambar yang diupload -->
                           <div class="w-48 h-48 bg-pink-50 rounded-lg p-2">
                               @if(session('uploadedImage'))
                                   <img src="{{ asset('storage/' . session('uploadedImage')) }}" 
                                        alt="Uploaded Image" 
                                        class="w-full h-full object-contain rounded">
                               @endif
                           </div>

                           <!-- Hasil Prediksi -->
                           <div class="w-48 h-48 bg-pink-100 rounded-lg flex items-center justify-center">
                               <span class="text-6xl font-bold text-pink-500">
                                   {{ session('prediction') }}
                               </span>
                           </div>
                       </div>
                   </div>
               @endif

               <!-- Sample Images -->
               <div class="mt-6">
                   <p class="text-sm text-gray-600 mb-2">No Image? Try one of these :</p>
                   <div class="flex justify-center gap-2">
                       <img src="{{ asset('images/sample1.jpg') }}" alt="Sample 1" class="w-16 h-16 rounded object-cover cursor-pointer">
                       <img src="{{ asset('images/sample2.jpg') }}" alt="Sample 2" class="w-16 h-16 rounded object-cover cursor-pointer">
                       <img src="{{ asset('images/sample3.jpg') }}" alt="Sample 3" class="w-16 h-16 rounded object-cover cursor-pointer">
                       <img src="{{ asset('images/sample4.jpg') }}" alt="Sample 4" class="w-16 h-16 rounded object-cover cursor-pointer">
                   </div>
               </div>
           </div>
       </div>
   </main>

   @include('layouts.footer')

   <!-- JavaScript untuk Preview dan Loading -->
   <script>
       function previewImage(input) {
           const preview = document.getElementById('imagePreview');
           const previewContainer = document.getElementById('imagePreviewContainer');

           if (input.files && input.files[0]) {
               const reader = new FileReader();

               reader.onload = function(e) {
                   preview.src = e.target.result;
                   previewContainer.style.display = 'block';
               }

               reader.readAsDataURL(input.files[0]);
           } else {
               preview.src = '';
               previewContainer.style.display = 'none';
           }
       }

       // Handle form submission
       document.getElementById('uploadForm').onsubmit = function() {
           document.getElementById('loadingIndicator').classList.remove('hidden');
           return true;
       }

       // Handle sample image clicks
       document.querySelectorAll('img[alt^="Sample"]').forEach(img => {
           img.addEventListener('click', async function() {
               try {
                   const response = await fetch(this.src);
                   const blob = await response.blob();
                   const file = new File([blob], 'sample.jpg', { type: 'image/jpeg' });
                   
                   const dataTransfer = new DataTransfer();
                   dataTransfer.items.add(file);
                   
                   const fileInput = document.getElementById('imageInput');
                   fileInput.files = dataTransfer.files;
                   
                   previewImage(fileInput);
               } catch (error) {
                   console.error('Error handling sample image:', error);
               }
           });
       });
   </script>
</body>
</html>