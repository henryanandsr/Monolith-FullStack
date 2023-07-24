<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Formatter;
use App\Models\Orders;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Orders::all();
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
        $data = Orders::where('user_id', $userId)->get();
        if (!$data->isEmpty()) {
            return Formatter::createApi(200, 'Data ditemukan', $data);
        } else {
            return Formatter::createApi(404, 'Data tidak ditemukan');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'product_id' => 'required',
                'quantity' => 'required',
            ]);
            $orderData = $request->all();
            $orderData['user_id'] = $request->user()->id;
            $order = Orders::create($orderData);
            $data = Orders::where('id', '=', $order->id)->get();

            if ($order) {
                return Formatter::createApi(201, 'Data berhasil ditambahkan', $data);
            } else {
                return Formatter::createApi(400, 'Data gagal ditambahkan');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return Formatter::createApi(500, 'Terjadi kesalahan');
        }
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
