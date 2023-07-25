<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Barang</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container p-4 m-4 bg-blue-50 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-2">{{ $barang['nama'] }}</h2>
        <p class="text-gray-700 mb-1">Harga: {{ $barang['harga'] }}</p>
        <p class="text-gray-700 mb-3">Stok: {{ $barang['stok'] }}</p>
        <a href="/beli/{{ $barang['id'] }}" class="px-4 py-2 bg-blue-500 text-blue rounded hover:bg-blue-600">
            Beli
        </a>
    </div>
</body>
</html>