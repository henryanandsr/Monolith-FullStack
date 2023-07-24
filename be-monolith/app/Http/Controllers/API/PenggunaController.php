<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Helpers\Formatter;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;


class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengguna::all();
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info($request->all());
        try{
            $request->validate([
                'username' => 'required|unique:pengguna',
                'email' => 'required|unique:pengguna',
                'password' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
            ]);
            $penggunaData = $request->all();
            $penggunaData['password'] = Hash::make($penggunaData['password']);
                        
            $pengguna = Pengguna::create($penggunaData);
            $data = Pengguna::where('id', '=', $pengguna->id)->get();

            if ($pengguna) {
                return Formatter::createApi(201, 'Data berhasil ditambahkan', $data);
            } else {
                return Formatter::createApi(400, 'Data gagal ditambahkan');
            }
        }
        catch(\Exception $e){
            return Formatter::createApi(400, 'Terjadi kesalahan');
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
