<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    private $param;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['data'] = DB::table('artikel')
            ->orderBy('id', 'desc')
            ->get();

        return view('artikel.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artikel.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $slug = Str::slug($request->judul);
            // Dokumen upload
            $file = $request->file('cover');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/artikel/' . $slug;
            if(!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            DB::table('artikel')
                ->insert([
                    'judul' => $request->judul,
                    'cover' => 'artikel/' . $slug . '/' .$filename,
                    'teks_artikel' => $request->teks_artikel,
                    'tanggal_artikel' => $request->tanggal ?? now(),
                    'created_at' => now()
                ]);

            DB::commit();
            Alert::success('Sukses', 'Artikel Berhasil Dibuat.');
            return redirect()->route('artikel.index');
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
        $this->param['data'] = DB::table('artikel')
            ->where('id', $id)
            ->first();

        return view('artikel.show', $this->param);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->param['data'] = DB::table('artikel')
            ->where('id', $id)
            ->first();

        return view('artikel.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            if($request->file('cover') != null) {
                $slug = Str::slug($request->judul);
                // Dokumen upload
                $file = $request->file('cover');
                $filename = $file->getClientOriginalName();
                $filePath = public_path() . '/upload/artikel/' . $slug;
                if(!File::isDirectory($filePath)) {
                    File::makeDirectory($filePath, 493, true);
                }
                $file->move($filePath, $filename);
    
                $filePathOld = DB::table('artikel')
                    ->where('id', $id)
                    ->first();
                if($filePathOld && $filePathOld->cover != null)
                    unlink(public_path() . '/upload/' . $filePathOld->cover);
                DB::table('artikel')
                    ->where('id', $id)
                    ->update([
                        'judul' => $request->judul,
                        'cover' => 'artikel/' . $slug . '/' .$filename,
                        'teks_artikel' => $request->teks_artikel,
                        'tanggal_artikel' => $request->tanggal ?? now(),
                        'updated_at' => now()
                    ]);
            } else {
                DB::table('artikel')
                    ->where('id', $id)
                    ->update([
                        'judul' => $request->judul,
                        'teks_artikel' => $request->teks_artikel,
                        'tanggal_artikel' => $request->tanggal ?? now(),
                        'updated_at' => now()
                    ]);
            }
            DB::commit();
            Alert::success('Sukses', 'Artikel Berhasil Diubah.');
            return redirect()->route('artikel.index');
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function report(Request $request) {
        DB::beginTransaction();
        try {
            DB::table('report_artikel')
                ->insert([
                    'id_artikel' => $request->id,
                    'saran_artikel' => $request->saran,
                    'tanggal_report' => now(),
                    'created_at' => now()
                ]);
            DB::commit();
            Alert::success('Sukses', 'Berhasil menambahkan laporan artikel');
            return redirect()->route('artikel.index');
        } catch(Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan.', $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan.', $e->getMessage());
            return redirect()->back();
        }
    }

    public function listReport () {
        $this->param['data'] = DB::table('report_artikel')
            ->join('artikel', 'artikel.id', 'report_artikel.id_artikel')
            ->select(
                'report_artikel.*',
                'artikel.judul'
            )
            ->orderBy('id', 'desc')
            ->get();
        
        return view('artikel.report.index', $this->param);
    }

    public function confirmReport(Request $request) {
        DB::beginTransaction();
        try {
            $id = $request->id;
            DB::table('report_artikel')
                ->where('id', $id)
                ->update([
                    'status' => 1
                ]);
            DB::commit();
            Alert::success('Sukses', 'Berhasil mengkonfirmasi laporan artikel')->autoClose(10000);
            return redirect()->route('artikel.edit', $id);
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
}
