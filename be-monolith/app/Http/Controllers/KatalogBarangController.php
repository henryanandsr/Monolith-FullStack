<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BarangRepositoryInterface;

class KatalogBarangController extends Controller
{
    protected $barang;

    public function __construct(BarangRepositoryInterface $barang)
    {
        $this->barang = $barang;
    }

    public function katalogBarang()
    {
        $currentPage = request('page', 1);
        $productsPerPage = 10;

        if ($search = request('search')) {
            $barangs = $this->barang->searchByName($search);
        } else {
            $barangs = $this->barang->getAll();
        }

        $indexOfLastProduct = $currentPage * $productsPerPage;
        $indexOfFirstProduct = $indexOfLastProduct - $productsPerPage;
        $currentProducts = array_slice($barangs, $indexOfFirstProduct, $productsPerPage);

        if (request()->ajax()) {
            return response()->json([
                'barangs' => $currentProducts,
                'pages' => ceil(count($barangs) / $productsPerPage),
            ]);
        }

        return view('katalog', ['barangs' => $barangs, 'productsPerPage' => $productsPerPage]);
    }

    public function detailBarang($id)
    {
        $barang = $this->barang->getById($id);

        return view('detail_barang', compact('barang'));
    }
    
    public function beliBarang($id)
    {
        $barang = $this->barang->getById($id);
        $quantity = 1;
        $totalCost = $barang['harga'] * $quantity;

        return view('beli_barang', compact('barang', 'quantity', 'totalCost'));
    }
}
