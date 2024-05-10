<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    private $param;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->has('id')) {
            $id = $request->get('id');
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

            $this->param['dataReview'] = DB::table('penilaian')
                ->where('id_lembaga', $id)
                ->join('petani', 'petani.id', 'penilaian.id_petani')
                ->join('users as u', 'u.id', 'petani.id_user')
                ->join('lembaga', 'lembaga.id', 'penilaian.id_lembaga')
                ->select(
                    'penilaian.*',
                    'petani.nama_petani',
                    'u.id as user_id_petani',
                    'lembaga.id_user as user_id_lembaga'
                )
                ->get();
                
            return view('detail', $this->param);
        }
        $this->param['data'] = DB::table('lembaga')
            ->select(
                'lembaga.*',
                DB::raw("IFNULL((SELECT TRUNCATE(AVG(nilai), 1) FROM penilaian as p WHERE id_lembaga = lembaga.id), 0) as nilai"),
                DB::raw("IFNULL((SELECT COUNT(*) FROM penilaian as p WHERE id_lembaga = lembaga.id), 0) as komen")
            )
            ->get();
        $this->param['listLayanan'] = DB::table('template_sertifikasi')
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();
            
        return view('home', $this->param);
    }

    public function profilLembaga(Request $request, $id) {
        try {
            $this->param['data'] = DB::table('lembaga')
                ->where('lembaga.id', $id)
                ->join('users', 'users.id', 'lembaga.id_user')
                ->select(
                    'users.username',
                    'users.email',
                    'lembaga.*'
                )
                ->first();

            return view('auth.detail-user', $this->param);
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    public function updateVerifLembaga(Request $request) {
        DB::beginTransaction();
        try {
            if($request->has('verif')) {
                DB::table('lembaga')
                    ->where('id', $request->id_lembaga)
                    ->update([
                        'status_verifikasi' => 1
                    ]);
            } else {
                DB::table('lembaga')
                    ->where('id', $request->id_lembaga)
                    ->update([
                        'status_verifikasi' => 0
                    ]);
            }
            DB::commit();
            Alert::success('Sukses', 'Berhasil mengubah data lembaga');
            return redirect()->route('index');
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

    public function downloadbuktiVerifLembaga($id) {
        $filePath = DB::table('lembaga')
            ->where('id', $id)
            ->first();
            
        $file = public_path() .'/upload/' . $filePath->bukti_akreditasi;
        return response()->download($file);
    }
}
