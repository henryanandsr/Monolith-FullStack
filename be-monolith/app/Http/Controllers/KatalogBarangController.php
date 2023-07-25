<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KatalogBarangController extends Controller
{
    public function katalogBarang()
    {
        $currentPage = request('page', 1);
        $productsPerPage = 10;

        // Make a GET request using Laravel's HTTP client
        $response = Http::get('https://singleservice-labpro-production.up.railway.app/barang');

        if (!$response->successful()) {
            // Handle the error, for example:
            return response()->json(['error' => 'GET request failed'], 500);
        }

        // Decode the JSON response
        $responseData = $response->json();

        // Get the 'data' array from the response
        $barangs = $responseData['data'];

        // Calculate the index of last product in the current page
        $indexOfLastProduct = $currentPage * $productsPerPage;
        // Calculate the index of first product in the current page
        $indexOfFirstProduct = $indexOfLastProduct - $productsPerPage;
        // Get products for the current page
        $currentProducts = array_slice($barangs, $indexOfFirstProduct, $productsPerPage);

        return view('katalog', ['barangs' => $barangs, 'productsPerPage' => $productsPerPage]);
    }

    public function detailBarang($id)
    {
        // Make a GET request using Laravel's HTTP client
        $response = Http::get('https://singleservice-labpro-production.up.railway.app/barang/' . $id);

        if (!$response->successful()) {
            // Handle the error, for example:
            return response()->json(['error' => 'GET request failed'], 500);
        }

        // Decode the JSON response
        $responseData = $response->json();

        // Get the 'data' from the response
        $barang = $responseData['data'];

        return view('detail_barang', compact('barang'));
    }
    public function beliBarang($id)
{
    $response = Http::get('https://singleservice-labpro-production.up.railway.app/barang/' . $id);

    if (!$response->successful()) {
        return response()->json(['error' => 'GET request failed'], 500);
    }

    // Decode the JSON response
    $responseData = $response->json();

    // Get the 'data' from the response
    $barang = $responseData['data'];
    $quantity = 1;
    $totalCost = $barang['harga'] * $quantity;

    return view('beli_barang', compact('barang', 'quantity', 'totalCost'));
}

}
