// main.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productForm');
    const productName = document.getElementById('productName');
    const productPrice = document.getElementById('productPrice');
    const productQuantity = document.getElementById('productQuantity');
    const productNameError = document.getElementById('productNameError');
    const productPriceError = document.getElementById('productPriceError');
    const productQuantityError = document.getElementById('productQuantityError');

    form.addEventListener('submit', function(event) {
        let hasError = false;
        productNameError.classList.add('hidden');
        productPriceError.classList.add('hidden');
        productQuantityError.classList.add('hidden');

        if (productName.value.trim() === '') {
            productNameError.classList.remove('hidden');
            hasError = true;
        }

        if (isNaN(productPrice.value) || parseFloat(productPrice.value) <= 0) {
            productPriceError.classList.remove('hidden');
            hasError = true;
        }

        if (isNaN(productQuantity.value) || parseInt(productQuantity.value) < 0) {
            productQuantityError.classList.remove('hidden');
            hasError = true;
        }

        if (hasError) {
            event.preventDefault();
        }
    });
});
