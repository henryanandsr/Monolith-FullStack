<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Formatter;
use App\Repositories\Interfaces\OrdersRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class OrdersController extends Controller
{
    protected $orders;

    public function __construct(OrdersRepositoryInterface $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->orders->all();
        if ($data) {
            return Formatter::createApi(200, 'Data ditemukan', $data);
        } else {
            return Formatter::createApi(404, 'Data tidak ditemukan');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getAuthenticatedUserOrders(Request $request)
    {
        $userId = $request->user()->id;
        $data = $this->orders->getByUserId($userId);

        $httpClient = new Client();
        $productMap = [];

        foreach ($data as $purchase) {
            if ($purchase->product_id && !isset($productMap[$purchase->product_id])) {
                // Make an API request to fetch the product data by ID
                $response = $httpClient->get('https://singleservice-labpro-production.up.railway.app/barang/' . $purchase->product_id);

                // Logging the API response for debugging
                Log::info('API response for product ID ' . $purchase->product_id . ': ' . $response->getBody());

                if ($response->getStatusCode() === 200) {
                    $productData = json_decode($response->getBody(), true);

                    // Check if the 'nama' key is present in the fetched data
                    if (isset($productData['data']['nama'])) {
                        $productMap[$purchase->product_id] = $productData;
                    } else {
                        // Product data is missing the 'nama' key, log the issue for debugging
                        Log::error('Product data missing "nama" key:', ['product_id' => $purchase->product_id]);
                    }
                } else {
                    // Failed API request, log the error for debugging
                    Log::error('Failed to fetch product data from API:', ['product_id' => $purchase->product_id]);
                }
            }
        }

        Log::info('Product map:', ['product_map' => $productMap]);
        Log::info('Purchases:', ['purchases' => $data]);
        return view('riwayat_pembelian', ['purchases' => $data, 'productMap' => $productMap]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Fetch the product information from the API
        $response = Http::get('https://singleservice-labpro-production.up.railway.app/barang/' . $request->product_id);
        $barang = json_decode($response->body())->data;
    
        // Validate the incoming request data
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Check if the quantity is available in stock
        $availableStock = $barang->stok;
        $quantity = $request->input('quantity');
    
        if ($quantity > $availableStock) {
            return redirect()->back()->withErrors(['quantity' => 'Stok tidak cukup']);
        }
    
        $user_id = auth()->id();
    
        if (!$user_id) {
            // return to login page or handle appropriately
            return redirect()->route('login.form');
        }
    
        // Create a new Order instance and fill it with the request data
        $order = $this->orders->create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $quantity,
        ]);
    
        // Update the stock quantity of the Barang
        $barang->stok -= $quantity;
        $updatedResponse = Http::put('https://singleservice-labpro-production.up.railway.app/barang/stok/' . $request->product_id, [
            'id' => $barang->id,
            'kode' => $barang->kode,
            'nama' => $barang->nama,
            'harga' => $barang->harga,
            'stok' => $barang->stok,
            'perusahaan_id' => $barang->perusahaan_id,
        ]);
    
        // Check if the PUT request was successful
        if ($updatedResponse->failed()) {
            // The PUT request failed, handle the error appropriately
            Log::error('Failed to update stock: ' . $updatedResponse->body());
            return redirect()->back()->withErrors(['error' => 'Failed to update stock']);
        }
        // Redirect back to a success page or wherever you want
        return redirect()->route('katalog.barang')->with('success', 'Pembelian berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
