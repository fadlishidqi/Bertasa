<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - BERTASA</title>
    @vite(['resources/css/app.css', 'resources/css/scrollhidden.css'])
    
    <style>
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .faq-answer.active {
            max-height: 500px;
            transition: max-height 0.5s ease-in;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #FFF5F7 0%, #FFF 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    @include('layouts.navbar')
    
    <main class="max-w-4xl mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <div class="flex justify-center gap-1 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>

            <h1 class="text-4xl font-bold mb-4 text-gray-900">Frequently Asked Questions</h1>
            <p class="text-gray-600 max-w-2xl mx-auto mb-12">
                Temukan jawaban atas pertanyaan umum tentang cara kerja dan fitur BERTASA,<br>
                platform komunikasi non-verbal untuk mendukung komunitas disabilitas.
            </p>

            <!-- FAQ Items -->
            <div class="max-w-3xl mx-auto space-y-4">
                @foreach($faqs as $faq)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden {{ $loop->first ? 'faq-active' : '' }}">
                    <button class="w-full text-left p-6 focus:outline-none focus:bg-gray-50" onclick="toggleFaq(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $faq->question }}</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500 transform transition-transform duration-300 {{ $loop->first ? 'rotate-180' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
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
            
            // Close all other FAQs
            document.querySelectorAll('.faq-answer').forEach(el => {
                if (el !== content) {
                    el.classList.remove('active');
                    el.previousElementSibling.querySelector('svg').classList.remove('rotate-180');
                    el.parentElement.classList.remove('faq-active');
                }
            });

            // Toggle current FAQ
            content.classList.toggle('active');
            icon.classList.toggle('rotate-180');
            faqItem.classList.toggle('faq-active');
        }

        // Add active class to first FAQ on page load
        document.addEventListener('DOMContentLoaded', function() {
            const firstFaq = document.querySelector('.bg-white');
            if (firstFaq) {
                firstFaq.classList.add('faq-active');
                firstFaq.querySelector('.faq-answer').classList.add('active');
                firstFaq.querySelector('svg').classList.add('rotate-180');
            }
        });
    </script>
</body>
</html>
