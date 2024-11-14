<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BERTASA - Bahasa Tangan Komunikasi Nyata</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        .upload-box {
            border: 2px dashed #FFC0CB;
            border-radius: 25px;
            padding: 100px;
            background: white;
            transition: all 0.3s;
        }
        .upload-box:hover {
            border-color: #EC4899;
        }
        .predict-button {
            background: #EC4899;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.25rem;
            margin-top: 40px;
        }
        .custom-gradient {
            background: radial-gradient(circle at top left, #ffcfe8 0%, #ffffff 50%, #ffe1f5 100%);
        }
    </style>
</head>
<body  class="custom-gradient min-h-screen">
 @include('layouts.navbar')
 
 <main class="max-w-5xl mx-auto px-4 py-10">
    <div class="text-center">
        <img src="/images/orangbanyakhome.png" alt="People Icons" class="h-20 mx-auto mb-4">
        
        <h1 class="text-5xl font-bold text-gray-900 mb-4">Bahasa Tangan, Komunikasi Nyata</h1>
        <h2 class="text-5xl font-bold text-gray-900 mt-4 mb-4">
            Jelajahi <span class="bg-pink-700 text-white px-6 py-2 rounded-lg transform -rotate-2 inline-block">BERTASA</span>
            <img src="/images/cursor.png" alt="Cursor" class="inline-block h-14 ml-4">
        </h2>
        
        <p class="text-black-600 text-lg max-w-4xl mx-auto mt-10 mb-16">
            BERTASA hadir sebagai jembatan komunikasi nyata. Dengan panduan dan informasi,
            kami siap membantu menjadikan bahasa isyarat lebih mudah dipelajari dan dimengerti oleh semua orang
        </p>

         <div class="max-w-3xl mx-auto">
             @if (session('error'))
                 <div class="mt-4 p-4 bg-red-100 text-red-800 rounded">
                     {{ session('error') }}
                 </div>
             @endif

             <form action="{{ route('process-image') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                 @csrf
                 <div class="space-y-4">
                     <!-- Preview Image Container -->
                     <div class="mt-2 hidden" id="imagePreviewContainer">
                         <div class="relative">
                             <img id="imagePreview" class="max-w-full rounded-lg border shadow-sm mx-auto" 
                                 style="max-height: 300px; object-fit: contain;">
                             <button type="button" 
                                     onclick="removeImage()" 
                                     class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                     <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                 </svg>
                             </button>
                         </div>
                     </div>

                     <!-- Upload Box -->
                     <label for="imageInput" id="uploadBox" 
                            class="block border-2 border-dashed border-pink-200 rounded-3xl py-20 hover:border-pink-500 transition-colors bg-white cursor-pointer">
                         <div class="text-center">
                             <img src="/images/galery-add.png" alt="Upload" class="mx-auto h-14 mb-8">
                             <input type="file" 
                                 name="image" 
                                 id="imageInput"
                                 accept="image/*" 
                                 class="hidden"
                                 onchange="previewImage(this)">
                            <p class="text-xl font-medium text-gray-800">Letakkan gambar di sini</p>
                            <p class="mt-2 text-sm text-gray-500">Ukuran file maksimum : 5 MB</p>
                         </div>
                     </label>

                     <button type="submit" 
                             class="bg-pink-700 text-white py-2 px-8 rounded-full hover:bg-pink-500 transition-colors text-lg font-semibold">
                         Prediksi
                     </button>
                 </div>
             </form>

             <div id="loadingIndicator" class="hidden mt-4">
                 <div class="flex items-center justify-center">
                     <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-pink-500"></div>
                     <span class="ml-2">Processing...</span>
                 </div>
             </div>

             <div class="mt-8">
                 <p class="text-sm text-black-600 mb-3 font-medium">No image? Try one of these :</p>
                 <div class="flex justify-center gap-3">
                     <img src="{{ asset('images/sample1.png') }}" alt="Sample 1" class="w-16 h-16 rounded-lg object-cover cursor-pointer hover:opacity-80 transition">
                     <img src="{{ asset('images/sample2.png') }}" alt="Sample 2" class="w-16 h-16 rounded-lg object-cover cursor-pointer hover:opacity-80 transition">
                     <img src="{{ asset('images/sample3.png') }}" alt="Sample 3" class="w-16 h-16 rounded-lg object-cover cursor-pointer hover:opacity-80 transition"> 
                     <img src="{{ asset('images/sample4.png') }}" alt="Sample 4" class="w-16 h-16 rounded-lg object-cover cursor-pointer hover:opacity-80 transition">
                 </div>
             </div>

             @if (session('prediction'))
                 <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                     <h2 class="text-2xl font-bold mb-4">Hasil Prediksi Huruf</h2>
                     <div class="flex justify-center items-center gap-8">
                         <div class="w-48 h-48 bg-pink-50 rounded-lg p-2">
                             @if(session('uploadedImage'))
                                 <img src="{{ asset('storage/' . session('uploadedImage')) }}" 
                                      alt="Uploaded Image" 
                                      class="w-full h-full object-contain rounded">
                             @endif
                         </div>

                         <div class="w-48 h-48 bg-pink-100 rounded-lg flex items-center justify-center">
                             <span class="text-6xl font-bold text-pink-500">
                                 {{ session('prediction') }}
                             </span>
                         </div>
                     </div>
                 </div>
             @endif
         </div>
     </div>
 </main>

 @include('layouts.footer')

 <script>
     function previewImage(input) {
         const preview = document.getElementById('imagePreview');
         const previewContainer = document.getElementById('imagePreviewContainer');
         const uploadBox = document.getElementById('uploadBox');

         if (input.files && input.files[0]) {
             const reader = new FileReader();

             reader.onload = function(e) {
                 preview.src = e.target.result;
                 previewContainer.classList.remove('hidden');
                 uploadBox.classList.add('hidden');
             }

             reader.readAsDataURL(input.files[0]);
         }
     }

     function removeImage() {
         const preview = document.getElementById('imagePreview');
         const previewContainer = document.getElementById('imagePreviewContainer');
         const uploadBox = document.getElementById('uploadBox');
         const fileInput = document.getElementById('imageInput');

         preview.src = '';
         previewContainer.classList.add('hidden');
         uploadBox.classList.remove('hidden');
         fileInput.value = '';
     }

     document.getElementById('uploadForm').onsubmit = function() {
         document.getElementById('loadingIndicator').classList.remove('hidden');
         return true;
     }

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