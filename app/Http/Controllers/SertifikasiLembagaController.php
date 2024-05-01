<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class SertifikasiLembagaController extends Controller
{
    private $param;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('template_sertifikasi');
        if(auth()->user()->role == 'Lembaga') {
            $idLembaga = DB::table('lembaga')
                ->where('id_user', auth()->user()->id)
                ->first();
            
            $data->where('id_lembaga', $idLembaga->id);
        }
        $this->param['data'] = $data->get();

        return view('Sertifikasi.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Sertifikasi.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $idLembaga = DB::table('lembaga')
                ->where('id_user', auth()->user()->id)
                ->first()->id;
            
            $dataPost = [];
            foreach ($request->nama_sertifikat as $key => $namaSertifikat) {
                // Dokumen upload
                $file = $request->file('kebutuhan_sertifikat')[$key];
                $filename = $file->getClientOriginalName();
                $filePath = public_path() . '/upload/' . 'dokumen-sertifikasi/' . $idLembaga;
                if(!File::isDirectory($filePath)) {
                    File::makeDirectory($filePath, 493, true);
                }
                $file->move($filePath, $filename);

                array_push($dataPost, [
                    'sertifikasi' => $namaSertifikat,
                    'id_lembaga' => $idLembaga,
                    'masa_berlaku' => $request->masa_berlaku[$key],
                    'template_sertifikasi' => 'dokumen-sertifikasi/' . $idLembaga . '/' . $filename,
                    'created_at' => now()
                ]);
            }

            DB::table('template_sertifikasi')
                ->insert($dataPost);
            DB::commit();

            Alert::success('Sukses', 'Berhasil menambahkan data sertifikasi.')->autoClose(10000);
            return redirect()->route('sertifikasi-lembaga.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan.', $e->getMessage())->autoClose(10000);
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan.', $e->getMessage())->autoClose(10000);
            return redirect()->back();
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
