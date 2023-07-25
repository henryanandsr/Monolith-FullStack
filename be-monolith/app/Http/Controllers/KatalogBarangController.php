<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KatalogBarangController extends Controller
{
    public function katalogBarang()
    {
        $currentPage = request('page', 1);
        $productsPerPage = 10;

        // Set the path to the cacert.pem file
        $cacertPath = 'D:\Download\cacert.pem';

        // Create a new cURL resource
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, 'https://singleservice-labpro-production.up.railway.app/barang');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, $cacertPath);

        // Execute the cURL request and store the response
        $response = curl_exec($ch);

        // Close the cURL resource
        curl_close($ch);

        // Check if cURL request was successful
        if ($response === false) {
            // Handle the error, for example:
            return response()->json(['error' => 'cURL request failed'], 500);
        }

        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Check if the JSON decoding was successful
        if ($responseData === null) {
            // Handle the error, for example:
            return response()->json(['error' => 'Failed to parse JSON response'], 500);
        }

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
        // Set the path to the cacert.pem file
        $cacertPath = 'D:\Download\cacert.pem';

        // Create a new cURL resource
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, 'https://singleservice-labpro-production.up.railway.app/barang/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, $cacertPath);

        // Execute the cURL request and store the response
        $response = curl_exec($ch);

        // Close the cURL resource
        curl_close($ch);

        // Check if cURL request was successful
        if ($response === false) {
            // Handle the error, for example:
            return response()->json(['error' => 'cURL request failed'], 500);
        }

        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Check if the JSON decoding was successful
        if ($responseData === null) {
            // Handle the error, for example:
            return response()->json(['error' => 'Failed to parse JSON response'], 500);
        }

        // Get the 'data' from the response
        $barang = $responseData['data'];

        return view('detail_barang', compact('barang'));
    }
    public function beliBarang($id)
    {
        // Fetch the data using the API endpoint
        $response = Http::get('https://singleservice-labpro-production.up.railway.app/barang/' . $id, ['withCredentials' => false]);

        if ($response->successful()) {
            $barang = $response->json()['data'];
        } else {
            // Handle the error if the API request fails
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
        
        $quantity = 1;
        $totalCost = $barang['harga'] * $quantity;

        return view('beli_barang', compact('barang', 'quantity', 'totalCost'));
    }
}
