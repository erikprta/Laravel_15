<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // untuk menampilkan data table produk
            $ar_produk = Produk::all();
            if (isset($ar_produk)) {
                $hasil = [
                    'message' => 'Data Produk',
                    'data' => $ar_produk,
                ];
                return response()->json($hasil, 200);
            } else {
                $fails = [
                    'message' => 'Data Produk Tidak Ditemukan',
                    'data' => $ar_produk,
                ];
                return response()->json($fails, 404);
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
        // menginput data produk
        $data = [
            'nama' => 'required',
            'stok' => 'integer',
            'harga' => 'required|integer',
            'idjenis' => 'integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Produk Tidak Tersimpan',
                'data' => $validator->errors(),
            ];
            return response()->json($fails, 404);
        } else {
            $ar_produk = new Produk();
            $ar_produk->nama = $request->input('nama');
            $ar_produk->stok = $request->input('stok');
            $ar_produk->harga = $request->input('harga');
            $ar_produk->idjenis = $request->input('idjenis');
            $ar_produk->save();
            $sukses = [
                'message' => 'Data Produk Tersimpan',
                'data' => $ar_produk,
            ];
            return response()->json($sukses, 200);
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
        // mengupdate data produk
        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:64',
            'stok' => 'integer',
            'harga' => 'integer',
            'idjenis' => 'integer',
        ]);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Produk Tidak Tersimpan',
                'data' => $validator->errors(),
            ];
            return response()->json($fails, 404);
        }

        $e_prd = Produk::find($id);
        if ($e_prd) {
            $e_prd->update($request->all());
            $sukses = [
                'message' => 'Data Produk Tersimpan',
                'data' => $e_prd,
            ];
            return response()->json($sukses, 200);
        } else {
            $fails = [
                'message' => 'Data Produk Tidak Ditemukan',
                'data' => $e_prd,
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $d_prd = Produk::where('id', $id)->first();
        if (isset($d_prd)) {
            $d_prd->delete();
                $hasil = [
                'message' => 'Data Produk Dihapus',
                'data' => $d_prd,
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'message' => 'Data Produk Tidak Ditemukan',
                'data' => $d_prd,
            ];
            return response()->json($fails, 404);
        }
    }
}