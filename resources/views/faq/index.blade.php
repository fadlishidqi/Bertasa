<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BERTASA - FAQ</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/scrollhidden.css', 'resources/css/faq.css','resources/js/faq.js'])
    
</head>
<body class="custom-gradient  min-h-screen">
    @include('layouts.navbar')
    
    <main class="max-w-4xl mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <div class="flex justify-center gap-1 mb-6">
            </div>

            <h1 class="text-4xl font-extrabold mb-4 text-black">Frequently Asked Questions</h1>
            <p class="text-gray-600 max-w-2xl mx-auto mb-16">
                Temukan jawaban atas pertanyaan umum tentang cara kerja dan fitur BERTASA, platform komunikasi non-verbal untuk mendukung komunitas disabilitas.
            </p>

            <!-- FAQ Items -->
            <div class="max-w-3xl mx-auto space-y-6">
                @foreach($faqs as $faq)
                <div class="transition-all duration-300 {{ $loop->first ? 'bg-white rounded-[24px] border-2 border-pink-500' : 'bg-white rounded-[24px]' }}"> <!-- Increased radius, removed shadow -->
                    <button class="w-full text-left p-6 focus:outline-none" onclick="toggleFaq(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-black">{{ $faq->question }}</h3> <!-- Changed to solid black -->
                            <div class="bg-pink-500 rounded-full p-2 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    class="h-6 w-6 text-white transform transition-transform duration-300 {{ $loop->first ? 'rotate-180' : '' }}" 
                                    viewBox="0 0 24 24" 
                                    fill="none" 
                                    stroke="currentColor">
                                    <path stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        stroke-width="2" 
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </button>
                    <div class="faq-answer {{ $loop->first ? 'active' : '' }}">
                        <div class="px-6 pb-6 text-gray-600 text-left">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>
