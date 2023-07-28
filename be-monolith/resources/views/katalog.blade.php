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
    <div class="p-4">
        <div class="container">
            <h1 class="text-center text-2xl font-bold pb-4">Katalog Barang</h1>
            @foreach ($barangs as $barang)
                <div class="p-4 m-4 bg-blue-50 rounded-lg shadow-md">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-gray-700 font-bold text-xl">{{ $barang['nama'] }}</h2>
                            <p>Harga : Rp {{ $barang['harga'] }}</p>
                            <p>Stock : {{ $barang['stok'] }}</p>
                        </div>
                        <div>
                            <a href="/barang/{{ $barang['id'] }}" class="font-bold text-blue-500">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
    
            <!-- Pagination -->
            <div>
                @for ($i = 1; $i <= ceil(count($barangs) / $productsPerPage); $i++)
                    <button onclick="paginate({{ $i }})" class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ $i }}</button>
                @endfor
            </div>
        </div>
    </div>

    <script>
        function paginate(pageNumber) {
            // Your pagination logic to update the view or redirect here
            // You can use JavaScript to handle pagination if needed
            window.location.href = '/katalog-barang?page=' + pageNumber;
        }
    </script>
</body>
</html>
