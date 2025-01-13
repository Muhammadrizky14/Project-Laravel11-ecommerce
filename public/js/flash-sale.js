document.addEventListener('DOMContentLoaded', function() {
    const productsContainer = document.getElementById('products-container');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const productCards = document.querySelectorAll('.product-card');
    let currentIndex = 0;

    function updateSlider() {
        const cardWidth = productCards[0].offsetWidth;
        productsContainer.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    if (prevButton && nextButton) {
        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentIndex < productCards.length - 4) {
                currentIndex++;
                updateSlider();
            }
        });
    }

    // Timer functionality
    function updateTimer() {
        const now = new Date().getTime();
        const endTime = new Date(window.flashSaleEndTime).getTime();
        const timeLeft = endTime - now;

        if (timeLeft > 0) {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        } else {
            clearInterval(timerInterval);
            document.getElementById('timer').textContent = 'Flash Sale Ended';
        }
    }

    if (window.flashSaleEndTime) {
        updateTimer();
        const timerInterval = setInterval(updateTimer, 1000);
    }
});

