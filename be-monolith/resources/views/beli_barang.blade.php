<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    @include('_navbar')
    <div class = "p-4">
        <div class="container p-4 bg-blue-50 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-2"><?= $barang['nama'] ?></h2>
            <p class="text-gray-700 mb-1">Harga: Rp <?= $barang['harga'] ?></p>
            <p class="text-gray-700 mb-3">Stok: <span id="stok"><?= $barang['stok'] ?></span></p>
            <p class="text-gray-700 mb-3">Total: Rp <span id="totalCost"><?= $totalCost ?></span></p>
            <div class="mb-2">
                <label class="block">Jumlah:</label>
                <input
                    id="quantity"
                    type="number"
                    min="1"
                    value="<?= $quantity ?>"
                    onchange="setQuantity(Number(this.value))"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <form id="orderForm" action="<?= route('orders.store') ?>" method="post"> <!-- Form submission to server-side OrdersController@store action -->
                @csrf <!-- CSRF protection token -->
                <input type="hidden" name="product_id" value="<?= $barang['id'] ?>">
                <input id="quantityInput" type="hidden" name="quantity" value="<?= $quantity ?>">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Beli
                </button>
            </form>
        </div>
    </div>
    <script>
        // Store the initial stock and total cost values
        const initialStock = <?= $barang['stok'] ?>;
        let totalCost = <?= $totalCost ?>;

        const setQuantity = (value) => {
            const harga = <?= $barang['harga'] ?>;
            // Update total cost
            totalCost = value * harga;
            document.getElementById('totalCost').innerText = totalCost;

            // Restore the original stock value
            const newStock = initialStock - value;
            document.getElementById('stok').innerText = newStock;

            // Update the quantity in the order form
            document.getElementById('quantityInput').value = value;
        };

        const handleBuy = () => {
            const newStock = initialStock - document.getElementById('quantity').value;
            if (newStock >= 0) {
                alert('Pembelian berhasil');
            } else {
                alert('Stok tidak cukup');
            }
        };

        // Call setQuantity initially to update the total cost and stock
        setQuantity(<?= $quantity ?>);
    </script>
</body>
</html>
