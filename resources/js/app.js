import './bootstrap';

function addToCart(productId, button) {
    // Add your cart logic here
    console.log('Adding product to cart:', productId);
    
    // Disable the button to prevent multiple clicks
    button.disabled = true;
    button.textContent = 'Adding...';

    // Make an AJAX request to add the item to the cart
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ quantity: 1 })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to the cart page
            window.location.href = '/cart';
        } else {
            // If there's an error, re-enable the button
            button.disabled = false;
            button.textContent = 'Add to cart';
            alert('Failed to add item to cart. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        button.disabled = false;
        button.textContent = 'Add to cart';
        alert('An error occurred. Please try again.');
    });
}

