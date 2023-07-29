<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\BarangRepositoryInterface;
use Illuminate\Support\Facades\Http;
use App\Models\Barang;

class BarangRepository implements BarangRepositoryInterface
{
    public function searchByName($name)
    {
        $barangs = $this->getAll();
    
        $filteredBarangs = array_filter($barangs, function($barang) use ($name) {
            return stripos($barang['nama'], $name) !== false; 
        });
    
        return array_values($filteredBarangs);
    }
    public function getAll()
    {
        $response = Http::get('https://singleservice-labpro-production.up.railway.app/barang');
        
        if (!$response->successful()) {
            // Handle the error, for example:
            throw new \Exception('GET request failed');
        }

        // Decode the JSON response
        $responseData = $response->json();

        // Get the 'data' array from the response
        $barangs = $responseData['data'];

        return $barangs;
    }

    public function getById($id)
    {
        $response = Http::get('https://singleservice-labpro-production.up.railway.app/barang/' . $id);

        if (!$response->successful()) {
            // Handle the error, for example:
            throw new \Exception('GET request failed');
        }

        // Decode the JSON response
        $responseData = $response->json();

        // Get the 'data' from the response
        $barang = $responseData['data'];

        return $barang;
    }
}
