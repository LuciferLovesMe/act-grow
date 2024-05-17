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
        return redirect()->route('index');
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
            return redirect()->route('index');
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
                $filePath = public_path() . '/upload/' . 'dokumen-sertifikasi/' . $idLembaga . '/' . $request->nama_sertifikat;
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
            return redirect()->route('index');
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
        $this->param['data'] = DB::table('template_sertifikasi as t')
            ->join('lembaga', 'lembaga.id', 't.id_lembaga')
            ->where('t.id', $id)
            ->select(
                't.*',
                'lembaga.nama_lembaga'
            )
            ->first();
        
        if(auth()->check()) {
            if(auth()->user()->role == 'Lembaga') {
                $idLembaga = DB::table('lembaga')
                    ->where('id_user', auth()->user()->id)
                    ->first()->id;
                if($idLembaga == $this->param['data']->id_lembaga) {
                    $this->param['canEdit'] = true;
                } else 
                    $this->param['canEdit'] = false;
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
        $this->param['data'] = DB::table('template_sertifikasi as t')
            ->join('lembaga', 'lembaga.id', 't.id_lembaga')
            ->where('t.id', $id)
            ->select(
                't.*',
                'lembaga.nama_lembaga'
            )
            ->first();
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

    public function gantiStatus(Request $request) {
        DB::beginTransaction();
        $message = '';

        try {
            if ($request->get('status') == 0 || $request->get('status') == '0') 
                $status = 'dibatalkan';
            else if($request->get('status') == 1 ||$request->get('status') == '1')
                $status = 'dalam proses';
            DB::table('sertifikasi')
                ->where('id', $request->get('id')) 
                ->update([
                    'status_sertifikasi' => $status
                ]);

            $message = 'sukses';
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
        } catch (QueryException $e) {
            DB::rollBack();
            $message = $e->getMessage();
        } finally {
            return response()->json([
                'message' => $message
            ]);
        }
    }

    public function uploadSertifikat(Request $request) {
        DB::beginTransaction();
        try {
            $data =  DB::table('sertifikasi as s')
                ->where('s.id', $request->id)
                ->join('template_sertifikasi as t', 't.id', 's.id_template_sertifikasi')
                ->join('petani as p', 'p.id', 's.id_petani')
                ->select(
                    's.*',
                    't.sertifikasi',
                    'p.nama_petani'
                )
                ->first();
                
            $file = $request->file('sertifikat');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/' . 'sertifikat-petani/' . $data->id . '/' . $data->id_petani;
            if(!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            DB::table('sertifikasi')
                ->where('id', $request->id)
                ->update([
                    'sertifikat' => 'sertifikat-petani/' . $data->id . '/' . $data->id_petani . '/' . $filename,
                    'status_sertifikasi' => 'selesai'
                ]);
            
            DB::commit();
            Alert::success('Sukses', 'Berhasil menambah data sertifikat.');
            return redirect()->route('show-permintaan-sertifikasi', $data->id_template_sertifikasi);
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }

    public function downloadSertifikat($id) {
        $filePath = DB::table('sertifikasi')
            ->where('id', $id)
            ->first();

        $file = public_path() .'/upload/' . $filePath->sertifikat;
        return response()->download($file);
    }

    public function postPenilaian(Request $request) {
        DB::beginTransaction();
        try {
            $idPetani = DB::table('petani')
                ->where('id_user', $request->id_petani)
                ->first()?->id;
            DB::table('penilaian')
                ->insert([
                    'id_lembaga' => $request->id_lembaga,
                    'id_petani' => $idPetani,
                    'komentar_petani' => $request->comment_petani,
                    'nilai' => $request->rating,
                    'created_at' => now()
                ]);
            DB::commit();

            Alert::success('Sukses', 'Berhasil menambahkan komentar.');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }

    public function ubahPenilaian(Request $request) {
        DB::beginTransaction();
        try {
            DB::table('penilaian')
                ->where('id', $request->id)
                ->update([
                    'komentar_petani' => $request->comment_petani,
                    'nilai' => $request->rating,
                    'updated_at' => now()
                ]);
            DB::commit();
            Alert::success('Sukses', 'Berhasil mengubah komentar');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    } 
    
    public function hapusPenilaian($id) {
        DB::beginTransaction();
        try {
            DB::table('penilaian')
                ->where('id', $id)
                ->delete();
            DB::commit();
            Alert::success('Sukses', 'Berhasil mengubah komentar');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }

    public function postLembaga(Request $request) {
        DB::beginTransaction();
        try {
            DB::table('penilaian')
                ->where('id', $request->id)
                ->update([
                    'komentar_lembaga' => $request->komentar_lembaga,
                    'updated_at' => now()
                ]);
            DB::commit();

            Alert::success('Sukses', 'Berhasil membalas komentar.');
            return redirect()->back();
        }catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusBalasanLembaga(Request $request) {
        DB::beginTransaction();
        try {
            DB::table('penilaian')
                ->where('id', $request->id)
                ->update([
                    'komentar_lembaga' => null,
                    'updated_at' => now()
                ]);
            DB::commit();

            Alert::success('Sukses', 'Berhasil menghapus balasan komentar.');
            return redirect()->back();
        }catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }

    public function ubahBalasanLembaga(Request $request) {
        DB::beginTransaction();
        try {
            DB::table('penilaian')
                ->where('id', $request->id)
                ->update([
                    'komentar_lembaga' => $request->komentar_lembaga,
                    'updated_at' => now()
                ]);
            DB::commit();

            Alert::success('Sukses', 'Berhasil mengubah balasan komentar.');
            return redirect()->back();
        }catch (Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }
}
