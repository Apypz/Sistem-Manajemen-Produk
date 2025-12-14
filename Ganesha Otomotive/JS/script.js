document.addEventListener('DOMContentLoaded', () => {
    // Akses elemen dengan ID "current-year" dan isi dengan tahun saat ini
    document.getElementById("current-year").textContent = new Date().getFullYear();
});

document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.badge-brand');
    const productCards = document.querySelectorAll('.product-col');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to the clicked button
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            productCards.forEach(card => {
                // Check if the card should be visible based on the filter
                if (filterValue === 'all' || card.classList.contains(filterValue)) {
                    card.classList.remove('hidden');
                    card.classList.add('visible');
                } else {
                    card.classList.remove('visible');
                    card.classList.add('hidden');
                }
            });
        });
    });
});

document.getElementById('scrollButton').addEventListener('click', function() {
    window.scrollTo(0, 800);
});