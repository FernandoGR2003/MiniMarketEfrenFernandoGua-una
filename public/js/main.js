document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('productForm');
    const productName = document.getElementById('productName');
    const productPrice = document.getElementById('productPrice');
    const productQuantity = document.getElementById('productQuantity');
    const productNameError = document.getElementById('productNameError');
    const productPriceError = document.getElementById('productPriceError');
    const productQuantityError = document.getElementById('productQuantityError');

    form.addEventListener('submit', function (event) {
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

        if (!hasError) {
            agregarProducto(productName.value, parseFloat(productPrice.value), parseInt(productQuantity.value));
            form.reset(); // Resetear el formulario después de agregar el producto
            event.preventDefault(); // Evitar el envío del formulario real
        } else {
            event.preventDefault(); // Evitar el envío del formulario si hay errores
        }
    });

    function agregarProducto(nombre, precio, cantidad) {
        const tableBody = document.querySelector('.product-table tbody');

        const valorTotal = precio * cantidad;
        const estado = cantidad > 0 ? 'En stock' : 'Agotado';

        const row = `
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">${nombre}</td>
                <td class="px-6 py-4 whitespace-nowrap">$${precio.toFixed(2)}</td>
                <td class="px-6 py-4 whitespace-nowrap">${cantidad}</td>
                <td class="px-6 py-4 whitespace-nowrap">$${valorTotal.toFixed(2)}</td>
                <td class="px-6 py-4 whitespace-nowrap">${estado}</td>
            </tr>
        `;

        tableBody.innerHTML += row;
    }
});
