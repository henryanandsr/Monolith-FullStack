<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Barang</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('_navbar')
    <div class="p-4">
        <div class="container p-4 bg-blue-50 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-2">{{ $barang['nama'] }}</h2>
            <p class="text-gray-700 mb-1">Harga: Rp {{ $barang['harga'] }}</p>
            <p class="text-gray-700 mb-3">Stok: {{ $barang['stok'] }}</p>
            <a href="/beli/{{ $barang['id'] }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Beli
            </a>
        </div>
    </div>
</body>
</html>