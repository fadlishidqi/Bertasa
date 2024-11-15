<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - BERTASA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/scrollhidden.css'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
    
        .faq-answer.active {
            max-height: 500px;
            transition: max-height 0.5s ease-in, border-top 0.3s ease-in;
        }

        .faq-answer.active > div {
            border-top: 1px solid #f3f4f6;
            padding-top: 1rem; /* Untuk memberi jarak antara garis dengan konten */
        }

        .custom-gradient {
            background: radial-gradient(circle at top left, #ffcfe8 0%, #ffffff 50%, #ffe1f5 100%);
        }
    </style>
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
            <div class="max-w-3xl mx-auto space-y-6"> <!-- Increased gap -->
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

    <script>
        function toggleFaq(button) {
            const faqItem = button.parentElement;
            const content = button.nextElementSibling;
            const icon = button.querySelector('svg');
            
            // Close all other FAQs and remove their borders
            document.querySelectorAll('.faq-answer').forEach(el => {
                if (el !== content) {
                    el.classList.remove('active');
                    el.previousElementSibling.querySelector('svg').classList.remove('rotate-180');
                    el.parentElement.classList.remove('border-2'); // Update this
                    el.parentElement.classList.remove('border-pink-500');
                }
            });

            // Toggle current FAQ
            content.classList.toggle('active');
            icon.classList.toggle('rotate-180');
            
            // Add border when expanded, remove when collapsed
            if (content.classList.contains('active')) {
                faqItem.classList.add('border-2', 'border-pink-500');
            } else {
                faqItem.classList.remove('border-2', 'border-pink-500');
            }
        }

        // Initial state - maybe we don't want any FAQ open by default
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-answer');
            faqItems.forEach(item => {
                if (item.classList.contains('active')) {
                    item.parentElement.classList.add('border-2', 'border-pink-500');
                }
            });
        });
    </script>
</body>
</html>
