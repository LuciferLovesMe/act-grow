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
                ->select(
                    'penilaian.*',
                    'petani.nama_petani'
                )
                ->get();
                
            return view('detail', $this->param);
        }
        $this->param['data'] = DB::table('lembaga')->get();

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
}
