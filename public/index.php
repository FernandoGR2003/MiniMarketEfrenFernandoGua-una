<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimarket - Gestión de Productos</title>
    <link href="./css/tailwind.css" rel="stylesheet">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body class="p-8">
    <h1 class="text-2xl mb-4">Gestión de Productos - Minimarket</h1>
    <form id="productForm" action="index.php" method="POST" class="w-full max-w-lg">
        <div class="mb-4">
            <label for="productName" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Producto:</label>
            <input type="text" id="productName" name="productName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <p id="productNameError" class="error hidden">El nombre del producto es requerido.</p>
        </div>
        <div class="mb-4">
            <label for="productPrice" class="block text-gray-700 text-sm font-bold mb-2">Precio por Unidad:</label>
            <input type="number" id="productPrice" name="productPrice" step="0.01" min="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <p id="productPriceError" class="error hidden">El precio debe ser mayor que cero.</p>
        </div>
        <div class="mb-4">
            <label for="productQuantity" class="block text-gray-700 text-sm font-bold mb-2">Cantidad en Inventario:</label>
            <input type="number" id="productQuantity" name="productQuantity" min="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <p id="productQuantityError" class="error hidden">La cantidad debe ser mayor o igual a cero.</p>
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Producto</button>
        </div>
    </form>

    <div class="mt-8">
        <?php
        $productos = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["productName"];
            $precio = floatval($_POST["productPrice"]);
            $cantidad = intval($_POST["productQuantity"]);

            if (!empty($nombre) && $precio > 0 && $cantidad >= 0) {
                agregarProducto($productos, $nombre, $precio, $cantidad);
            }
        }

        if (!empty($productos)) {
            mostrarProductos($productos);
        }

        function agregarProducto(&$productos, $nombre, $precio, $cantidad) {
            $productos[] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad,
            ];
        }

        function mostrarProductos($productos) {
            echo '<h2 class="text-xl mb-4">Lista de Productos</h2>';
            echo '<table class="min-w-full divide-y divide-gray-200">';
            echo '<thead class="bg-gray-50">';
            echo '<tr>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del Producto</th>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio por Unidad</th>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad de Inventario</th>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor Total</th>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="bg-white divide-y divide-gray-200">';
            
            foreach ($productos as $producto) {
                $valorTotal = $producto['precio'] * $producto['cantidad'];
                $estado = ($producto['cantidad'] > 0) ? 'En stock' : 'Agotado';

                echo '<tr>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($producto['nombre']) . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">$' . htmlspecialchars($producto['precio']) . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($producto['cantidad']) . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">$' . htmlspecialchars($valorTotal) . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($estado) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
        ?>
    </div>

    <script src="main.js"></script>
    <script>
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
    </script>
</body>
</html>
