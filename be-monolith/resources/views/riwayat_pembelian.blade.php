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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center font-bold">Riwayat Pembelian</h1>
                </div>
                <div class="card-body">
                    @if($purchases->isEmpty())
                    <p class="text-center">No purchase history found.</p>
                    @else
                    <div class="list-group">
                        @foreach ($purchases as $purchase)
                        @php $product = $productMap[$purchase->product_id]['data']; @endphp
                        @if(isset($product['nama']))
                        <h3 class="font-bold">{{ $product['nama'] }}</h3>
                        <p class="text-gray-700">Jumlah: {{ $purchase->quantity }}</p>
                        <p class="text-gray-700">Total: {{ $purchase->quantity * ($product['harga'] ?? 0) }}</p>
                        @else
                        <h3 class="font-bold">Product not available</h3>
                        <p class="text-gray-700">Jumlah: {{ $purchase->quantity }}</p>
                        @endif 
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $purchases->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>