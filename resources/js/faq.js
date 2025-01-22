// resources/js/faq.js

window.toggleFaq = function(button) {
    const faqItem = button.parentElement;
    const content = button.nextElementSibling;
    const icon = button.querySelector('svg');
    
    document.querySelectorAll('.faq-answer').forEach(el => {
        if (el !== content) {
            el.classList.remove('active');
            el.previousElementSibling.querySelector('svg').classList.remove('rotate-180');
            el.parentElement.classList.remove('border-2');
            el.parentElement.classList.remove('border-pink-500');
        }
    });
 
    content.classList.toggle('active');
    icon.classList.toggle('rotate-180');
    
    if (content.classList.contains('active')) {
        faqItem.classList.add('border-2', 'border-pink-500');
    } else {
        faqItem.classList.remove('border-2', 'border-pink-500');
    }
 }
 
 export function initializeFaq() {
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-answer');
        faqItems.forEach(item => {
            if (item.classList.contains('active')) {
                item.parentElement.classList.add('border-2', 'border-pink-500');
            }
        });
    });
 }