<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;
use Illuminate\Support\Facades\Validator;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // untuk menampilkan data table jenis
        $ar_jenis = Jenis::all();
        if (isset($ar_jenis)) {
            $hasil = [
                'message' => 'Data Jenis',
                'data' => $ar_jenis,
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'message' => 'Data Jenis Tidak Ditemukan',
                'data' => $ar_jenis,
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
        // menginput data jenis
        $data = [
            'nama' => 'required|max:64',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Jenis Tidak Tersimpan',
                'data' => $validator->errors(),
            ];
            return response()->json($fails, 404);
        } else {
            $data_jenis = new Jenis();
            $data_jenis->nama = $request->input('nama');
            $data_jenis->save();
            $success = [
                'message' => 'Data Jenis Tersimpan',
                'data' => $data_jenis,
            ];
            return response()->json($success, 200);
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
        // mengupdate data jenis
        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:64',
        ]);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Jenis Tidak Tersimpan',
                'data' => $validator->errors(),
            ];
            return response()->json($fails, 404);
        }

        $e_jenis = Jenis::find($id);
        if ($e_jenis) {
            $e_jenis->update($request->all());
            $sukses = [
                'message' => 'Data Jenis Tersimpan',
                'data' => $e_jenis,
            ];
            return response()->json($sukses, 200);
        } else {
            $fails = [
                'message' => 'Data Jenis Tidak Ditemukan',
                'data' => $e_jenis,
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // menghapus data jenis
        $d_jenis = Jenis::where('id', $id)->first();
        if (isset($d_jenis)) {
            $d_jenis->delete();
            $sukses = [
                'message' => 'Data Jenis Tersimpan',
                'data' => $d_jenis,
            ];
            return response()->json($sukses, 200);
        } else {
            $fails = [
                'message' => 'Data Jenis Tidak Ditemukan',
                'data' => $d_jenis,
            ];
            return response()->json($fails, 404);
        }
    }
}