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
    <div class="container p-4 m-4">
        <h1 class="text-center text-2xl font-bold pb-4">Katalog Barang</h1>
        @foreach ($barangs as $barang)
            <div class="bg-blue-200 my-3 p-2 rounded-md">
                <h2 class="text-xl font-bold">{{ $barang['nama'] }}</h2>
                <p>Harga : {{ $barang['harga'] }}</p>
                <p>Stock : {{ $barang['stok'] }}</p>
                <a href="/barang/{{ $barang['id'] }}" class="text-blue-600">Detail</a>
            </div>
        @endforeach

        <!-- Pagination -->
        <div>
            @for ($i = 1; $i <= ceil(count($barangs) / $productsPerPage); $i++)
                <button onclick="paginate({{ $i }})">{{ $i }}</button>
            @endfor
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function paginate(pageNumber) {
            // Your pagination logic to update the view or redirect here
            // You can use JavaScript to handle pagination if needed
            window.location.href = '/katalog-barang?page=' + pageNumber;
        }
    </script>
</body>
</html>
