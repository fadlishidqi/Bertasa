// resources/js/flipcard.js

export function initializeFlipcard() {
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.flip-card').forEach(card => {
            card.addEventListener('click', () => {
                card.classList.toggle('flipped');
            });
        });
    });
}