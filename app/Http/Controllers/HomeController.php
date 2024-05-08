<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
