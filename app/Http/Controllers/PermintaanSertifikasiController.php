<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class PermintaanSertifikasiController extends Controller
{
    private $param;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->param['dataSertifikasi'] = DB::table('template_sertifikasi')
            ->where('id', $request->get('id'))
            ->first();
        $this->param['dataUser'] = DB::table('petani')
            ->where('id_user', auth()->user()->id)
            ->first();
        $this->param['data'] = DB::table('lembaga')
            ->where('t.id', $request->get('id'))
            ->join('template_sertifikasi as t', 't.id_lembaga', 'lembaga.id')
            ->first();

        return view('permintaan-sertifikasi.add', $this->param);
    }

    public function uploadKetentuan(Request $request) {
        $this->param['dataSertifikasi'] = DB::table('template_sertifikasi')
            ->where('id', $request->get('id'))
            ->first();
        $this->param['dataUser'] = DB::table('petani')
            ->where('id_user', auth()->user()->id)
            ->first();
        $this->param['data'] = DB::table('lembaga')
            ->where('t.id', $request->get('id'))
            ->join('template_sertifikasi as t', 't.id_lembaga', 'lembaga.id')
            ->first();
            
        return view('permintaan-sertifikasi.upload-ketentuan', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $idPetani = DB::table('petani')
                ->where('id_user', auth()->user()->id)
                ->first()?->id;
            $idTemplateSertifikasi = $request->id_template_sertifikasi;
            // Dokumen upload
            $file = $request->file('file_ketentuan');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/' . 'dokumen-permintaan-sertifikasi/' . $idTemplateSertifikasi . '/' . $idPetani;
            if(!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            DB::table('sertifikasi')
                ->insert([
                    'id_petani' => $idPetani,
                    'id_template_sertifikasi' => $idTemplateSertifikasi,
                    'status_sertifikasi' => 'menunggu verifikasi',
                    'berkas_sertifikasi' => 'dokumen-permintaan-sertifikasi/' . $idTemplateSertifikasi . '/' . $idPetani . '/' . $filename,
                    'created_at' => now()
                ]);

            DB::commit();

            Alert::success('Sukses', 'Berhasil menambahkan data permintaan sertifikasi.');
            return redirect()->route('permintaan-sertifikasi.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan.', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan.', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->param['data'] = DB::table('lembaga')
            ->where('lembaga.id', $id)
            ->join('users', 'users.id', 'lembaga.id_user')
            ->select(
                'lembaga.*',
                'users.email'
            )
            ->first();
        $this->param['dataSertifikasi'] = DB::table('template_Sertifikasi')
            ->where('id_lembaga', $id)
            ->get();
        
        return view('permintaan-sertifikasi.show', $this->param);
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

    public function lihatPermintaan(Request $request) {
        try {
            if(auth()->user()->role == 'Petani') {
                $idPetani = DB::table('petani')
                    ->where('id_user', auth()->user()->id)
                    ->first()?->id;
    
                $this->param['data'] = DB::table('sertifikasi')
                    ->join('petani', 'petani.id', 'sertifikasi.id_petani')
                    ->where('id_petani', $idPetani)
                    ->where('template_sertifikasi.id_lembaga', $request->get('idLembaga'))
                    ->join('template_sertifikasi', 'template_sertifikasi.id', 'sertifikasi.id_template_sertifikasi')
                    ->select(
                        'sertifikasi.*',
                        'template_sertifikasi.sertifikasi',
                        'petani.nama_petani'
                    )
                    ->orderBy('sertifikasi.id', 'desc')
                    ->get();
            } else {
                $this->param['data'] = DB::table('sertifikasi')
                    ->join('petani', 'petani.id', 'sertifikasi.id_petani')
                    ->where('template_sertifikasi.id_lembaga', $request->get('idLembaga'))
                    ->join('template_sertifikasi', 'template_sertifikasi.id', 'sertifikasi.id_template_sertifikasi')
                    ->select(
                        'sertifikasi.*',
                        'template_sertifikasi.sertifikasi',
                        'petani.nama_petani'
                    )
                    ->orderBy('sertifikasi.id', 'desc')
                    ->get();

            }

            $this->param['dataLembaga'] = DB::table('lembaga')
                ->where('id', $request->get('idLembaga'))
                ->first();
                
            return view('permintaan-sertifikasi.lihat-permintaan', $this->param);
        } catch (Exception $e) {
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            return $e;
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }
}
