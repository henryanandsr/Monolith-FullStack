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
        <div class="container">
            <h1 class="text-center text-2xl font-bold pb-4">Katalog Barang</h1>
            <form action="/katalog-barang" method="GET" class="w-full flex flex-col md:flex-row md:items-center p-4">
                <input type="text" name="search" placeholder="Search by nama barang" class="px-3 py-2 border rounded-md w-full md:mr-2 mb-2 md:mb-0">
                <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded-md w-full md:w-auto">Search</button>
            </form>
            <div id="barangs">
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
            </div>
            <div id="pagination">
                @for ($i = 1; $i <= ceil(count($barangs) / $productsPerPage); $i++)
                    <button onclick="paginate({{ $i }})" class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ $i }}</button>
                @endfor
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function refreshData() {
            location.reload();            
        }
        setInterval(refreshData, 1000);
    </script>
</body>
</html>
