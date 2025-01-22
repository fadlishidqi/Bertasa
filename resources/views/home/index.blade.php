<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BERTASA - Bersuara Tanpa Suara</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Session Messages -->
    @if(session('success'))
        <meta name="success-message" content="{{ session('success') }}">
    @endif
    @if(session('error'))
        <meta name="error-message" content="{{ session('error') }}">
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <meta name="error-message" content="{{ $error }}">
        @endforeach
    @endif

    @vite(['resources/js/app.js', 'resources/css/scrollhidden.css', 'resources/css/home.css'])
</head>
<body class="custom-gradient min-h-screen">
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
                <form action="{{ route('process-image') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Preview Image Container -->
                        <div class="mt-2 hidden" id="imagePreviewContainer">
                            <div class="relative">
                                <img id="imagePreview" class="max-w-full rounded-lg border shadow-sm mx-auto" 
                                    style="max-height: 300px; object-fit: contain;">
                                <button type="button" 
                                        id="removeImageBtn"
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
                                    class="hidden">
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

                <!-- Loading Indicator -->
                <div id="loadingIndicator" class="hidden mt-4">
                    <div class="flex items-center justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-pink-500"></div>
                        <span class="ml-2">Processing...</span>
                    </div>
                </div>

                <!-- Sample Images -->
                <div class="mt-8">
                    <p class="text-sm text-black-600 mb-3 font-medium">No image? Try one of these :</p>
                    <div class="flex justify-center gap-3">
                        <img src="{{ asset('images/sample1.png') }}" alt="Sample 1" class="w-16 h-16 rounded-lg object-cover cursor-pointer hover:opacity-80 transition">
                        <img src="{{ asset('images/sample2.png') }}" alt="Sample 2" class="w-16 h-16 rounded-lg object-cover cursor-pointer hover:opacity-80 transition">
                        <img src="{{ asset('images/sample3.png') }}" alt="Sample 3" class="w-16 h-16 rounded-lg object-cover cursor-pointer hover:opacity-80 transition"> 
                        <img src="{{ asset('images/sample4.png') }}" alt="Sample 4" class="w-16 h-16 rounded-lg object-cover cursor-pointer hover:opacity-80 transition">
                    </div>
                </div>

                <!-- Prediction Result -->
                @if (session('prediction'))
                <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Hasil Prediksi Huruf</h2>
                    <div class="flex justify-center items-center gap-12">
                        <!-- Image Preview -->
                        <div class="w-64 h-64 bg-gray-50 rounded-lg p-2 shadow-sm">
                            @if(session('uploadedImage'))
                                <img src="{{ asset('storage/' . session('uploadedImage')) }}" 
                                    alt="Uploaded Image" 
                                    class="w-full h-full object-contain rounded">
                            @endif
                        </div>

                        <!-- Prediction Box -->
                        <div class="w-64 bg-pink-50 rounded-lg p-6">
                            <!-- Predicted Letter -->
                            <div class="text-center mb-6">
                                <span class="text-8xl font-bold text-pink-500">
                                    {{ session('prediction') }}
                                </span>
                            </div>

                            <!-- Confidence Bar -->
                            @if(session('confidence'))
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm uppercase">
                                    <span class="font-semibold text-gray-600">CONFIDENCE</span>
                                    <span class="font-bold text-pink-600">{{ number_format(session('confidence'), 1) }}%</span>
                                </div>
                                <div class="h-2 rounded-full bg-gray-200">
                                    <div class="h-full rounded-full bg-pink-500 transition-all"
                                        style="width: {{ session('confidence') }}%">
                                    </div>
                                </div>
                                
                                <!-- Status Badge -->
                                <div class="mt-4 text-center">
                                    @if(session('confidence') >= 70.0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Prediksi Berhasil
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            Prediksi Kurang Yakin
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Warning Message for Low Confidence -->
                    @if(session('confidence') < 70.0)
                        <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                            <p class="text-yellow-800 text-sm">
                                <span class="font-semibold">Catatan:</span> 
                                Tingkat keyakinan prediksi di bawah 80%. Silakan coba mengambil gambar ulang dengan pencahayaan yang lebih baik 
                                atau posisi tangan yang lebih jelas.
                            </p>
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>