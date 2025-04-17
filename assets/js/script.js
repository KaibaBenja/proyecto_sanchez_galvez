// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.product-card .btn-primary');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productCard = this.closest('.product-card');
            const productTitle = productCard.querySelector('.product-title').textContent;
            
            // Show notification
            alert(`¡${productTitle} añadido al carrito!`);
            
            // Update cart count (this would be more sophisticated in a real app)
            const cartCount = document.querySelector('.nav-link i.fas.fa-shopping-cart').parentNode;
            const currentText = cartCount.textContent;
            const currentCount = parseInt(currentText.match(/\d+/)[0]);
            cartCount.textContent = currentText.replace(/\d+/, currentCount + 1);
        });
    });

    // Wishlist functionality
    const wishlistButtons = document.querySelectorAll('.btn-wishlist');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#dc3545';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '';
            }
        });
    });

    // Newsletter form submission
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value;
            
            // In a real application, you would send this to your server
            alert(`¡Gracias por suscribirte con ${email}! Recibirás nuestras ofertas pronto.`);
            emailInput.value = '';
        });
    }
});
