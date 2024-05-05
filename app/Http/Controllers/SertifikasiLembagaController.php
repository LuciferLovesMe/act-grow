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
        $data = DB::table('lembaga');
        $this->param['data'] = $data->get();

        return view('sertifikasi.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sertifikasi.add');
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
                $filePath = public_path() . '/upload/' . 'dokumen-sertifikasi/' . $idLembaga . '/' . $namaSertifikat;
                if(!File::isDirectory($filePath)) {
                    File::makeDirectory($filePath, 493, true);
                }
                $file->move($filePath, $filename);

                array_push($dataPost, [
                    'sertifikasi' => $namaSertifikat,
                    'id_lembaga' => $idLembaga,
                    'masa_berlaku' => $request->masa_berlaku[$key],
                    'template_sertifikasi' => 'dokumen-sertifikasi/' . $idLembaga . '/' . $namaSertifikat . '/' . $filename,
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
        $this->param['data'] = DB::table('lembaga')
            ->where('id', $id)
            ->first();
        $this->param['dataSertifikasi'] = DB::table('template_Sertifikasi')
            ->where('id_lembaga', $id)
            ->get();
        if(auth()->check()) {
            $idLembaga = DB::table('lembaga')
                ->where('id_user', auth()->user()->id)
                ->first()->id;
            if($id == $idLembaga) {
                $this->param['canEdit'] = true;
            } else 
                $this->param['canEdit'] = false;
        } else
            $this->param['canEdit'] = false;
        
        return view('sertifikasi.show', $this->param);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $this->param['data'] = DB::table('template_sertifikasi')
                ->where('id', $id)
                ->first();

            return view('sertifikasi.edit', $this->param);
        } catch (Exception $e) {
            Alert::error('Terjadi kesalahan.', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Terjadi kesalahan.', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            if($request->file('kebutuhan_sertifikat') != null) {
                $idLembaga = DB::table('lembaga')
                    ->where('id_user', auth()->user()->id)
                    ->first()->id;
                    
                $file = $request->file('kebutuhan_sertifikat');
                $filename = $file->getClientOriginalName();
                $filePath = public_path() . '/upload/' . 'dokumen-sertifikasi/' . $idLembaga . '/' . $request->nama_sertifikat . '/' . $filename;
                if(!File::isDirectory($filePath)) {
                    File::makeDirectory($filePath, 493, true);
                }
                $file->move($filePath, $filename);

                $filePathOld = DB::table('template_sertifikasi')
                    ->where('id', $id)
                    ->first();
                unlink(public_path() . '/upload/' . $filePathOld->template_sertifikasi);

                DB::table('template_sertifikasi')
                    ->where('id', $id)
                    ->update([
                        'template_sertifikasi' => 'dokumen-sertifikasi/' . $idLembaga . '/' . $request->nama_sertifikat . '/' . $filename,
                        'sertifikasi' => $request->nama_sertifikat,
                        'masa_berlaku' => $request->masa_berlaku,
                        'updated_at' => now()
                    ]);
            } else {
                DB::table('template_sertifikasi')
                    ->where('id', $id)
                    ->update([
                        'sertifikasi' => $request->nama_sertifikat,
                        'masa_berlaku' => $request->masa_berlaku,
                        'updated_at' => now()
                    ]);
            }

            DB::commit();
            Alert::success('Sukses', 'Berhasil mengubah data template sertifikasi');
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showDetailSertifikasi($id) {
        $this->param['data'] = DB::table('template_sertifikasi')
            ->where('id', $id)
            ->first();
        
        if(auth()->check()) {
            $idLembaga = DB::table('lembaga')
                ->where('id_user', auth()->user()->id)
                ->first()->id;
            if($idLembaga == $this->param['data']->id_lembaga) {
                $this->param['canEdit'] = true;
            } else 
                $this->param['canEdit'] = false;
        } else
            $this->param['canEdit'] = false;
            
        return view('sertifikasi.detail-sertifikasi', $this->param);
    }

    public function downloadKetentuan($id) {
        $filePath = DB::table('template_Sertifikasi')
            ->where('id', $id)
            ->first();

        $file = public_path() .'/upload/' . $filePath->template_sertifikasi;
        return response()->download($file);
    }

    public function showPermintaanSertifikasi($id) {
        $this->param['dataSertifikasi'] = DB::table('template_sertifikasi')
            ->where('id', $id)
            ->first();
        $this->param['listSertifikasi'] = DB::table('sertifikasi as s')
            ->where('s.id_template_sertifikasi', $id)
            ->join('template_sertifikasi as t', 't.id', 's.id_template_sertifikasi')
            ->join('petani as p', 'p.id', 's.id_petani')
            ->select(
                's.*',
                't.sertifikasi',
                'p.nama_petani'
            )
            ->get();

        return view('sertifikasi.show-permintaan', $this->param);
    }

    public function detailPermintaanSertifikasi($id) {
        $this->param['data'] = DB::table('sertifikasi as s')
            ->where('s.id', $id)
            ->join('template_sertifikasi as t', 't.id', 's.id_template_sertifikasi')
            ->join('petani as p', 'p.id', 's.id_petani')
            ->select(
                's.*',
                't.sertifikasi',
                'p.nama_petani'
            )
            ->first();

        return view('Sertifikasi.detail-permintaan', $this->param);
    }

    public function downloadKetentuanPetani($id) {
        $filePath = DB::table('sertifikasi')
            ->where('id', $id)
            ->first();

        $file = public_path() .'/upload/' . $filePath->berkas_sertifikasi;
        return response()->download($file);
    }
}
