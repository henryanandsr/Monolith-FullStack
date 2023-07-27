<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Helpers\Formatter;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Repositories\Interfaces\PenggunaRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    protected $penggunaRepository;

    public function __construct(PenggunaRepositoryInterface $penggunaRepository)
    {
        $this->penggunaRepository = $penggunaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->penggunaRepository->all();
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
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:pengguna',
            'email' => 'required|unique:pengguna',
            'password' => 'required|min:8',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $penggunaData = $request->all();
        try {
            $pengguna = $this->penggunaRepository->create($penggunaData);
            if ($pengguna) {
                return redirect()->route('login')->with('success', 'User registered successfully');
            } else {
                return redirect()->back()->with('error', 'Data gagal ditambahkan');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
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
