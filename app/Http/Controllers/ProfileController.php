<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show() {
        if(auth()->user()->role == 'Lembaga') {
            $this->param['data'] = DB::table('lembaga')
                ->join('users', 'users.id', 'lembaga.id_user')
                ->where('users.id', auth()->user()->id)
                ->select(
                    'users.username',
                    'users.email',
                    'lembaga.*'
                )
                ->first();
            return view('auth.profile.lembaga', $this->param);
        } else if(auth()->user()->role == 'Petani') {
            $this->param['data'] = DB::table('petani')
                ->join('users', 'users.id', 'petani.id_user')
                ->where('users.id', auth()->user()->id)
                ->select(
                    'users.username',
                    'users.email',
                    'petani.*'
                )
                ->first();
            return view('auth.profile.petani', $this->param);
        } else {
            return redirect()->back();
        }
    }

    public function postLembaga ($id, Request $request) {
        DB::beginTransaction();
        try {
            // Upload Akreditasi
            if($request->file('bukti_akreditasi') != null) {
                $fileAkreditasi = $request->file('bukti_akreditasi');
                $filenameAkreditasi = $fileAkreditasi->getClientOriginalName();
                $filePathAkreditasi = public_path() . '/upload/' . 'dokumen-users/lembaga/' . $id . '/bukti-akreditasi';
                if(!File::isDirectory($filePathAkreditasi)) {
                    File::makeDirectory($filePathAkreditasi, 493, true);
                }
                $fileAkreditasi->move($filePathAkreditasi, $filenameAkreditasi);
            } else {
                $filenameAkreditasi = null;
            }
            // Upload Akreditasi
            if($request->file('foto') != null) {
                $fileFoto = $request->file('foto');
                $filenameFoto = $fileFoto->getClientOriginalName();
                $filePathFoto = public_path() . '/upload/' . 'dokumen-users/lembaga/' . $id . '/bukti-Foto';
                if(!File::isDirectory($filePathFoto)) {
                    File::makeDirectory($filePathFoto, 493, true);
                }
                $fileFoto->move($filePathFoto, $filenameFoto);
            } else {
                $filenameFoto = null;
            }

            if($request->password != null) {
                DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'email' => $request->email,
                        'updated_at' => now()
                    ]);
            } else {
                DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'email' => $request->email,
                        'updated_at' => now()
                    ]);
            }
            
            DB::table('lembaga')
                ->where('id_user', $id)
                ->update([
                    'nama_lembaga' => $request->name,
                    'tahun_berdiri' => $request->tahun_berdiri,
                    'alamat_lembaga' => $request->alamat,
                    'no_hp_lembaga' => $request->no_hp,
                    'deskripsi_lembaga' => $request->deskripsi,
                    'bukti_akreditasi' => $request->file('bukti_akreditasi') != null ? 'dokumen-users/lembaga/' . $id . '/bukti-akreditasi/' . $filenameAkreditasi : null,
                    'foto_lembaga' => $request->file('foto') != null ? 'dokumen-users/lembaga/' . $id . '/bukti-foto/' . $filenameFoto : null,
                ]);
            DB::commit();

            Alert::success('Sukses', 'Berhasil mengubah profil');
            return redirect()->route('index');
        } catch(Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch(QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }

    public function postPetani ($id, Request $request) {
        DB::beginTransaction();
        try {
            if($request->password != null) {
                DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'updated_at' => now()
                    ]);
            } else {
                DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'updated_at' => now()
                    ]);
            }

            DB::table('petani')
                ->where('id_user', $id)
                ->update([
                    'nama_petani' => $request->name,
                    'jenis_petani' => $request->jenis_petani,
                    'alamat_petani' => $request->alamat,
                    'no_hp_petani' => $request->no_hp_petani,
                ]);
            DB::commit();
            
            Alert::success('Sukses', 'Berhasil mengubah profil');
            return redirect()->route('index');
        } catch(Exception $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        } catch(QueryException $e) {
            DB::rollBack();
            Alert::error('Terjadi kesalahan', $e->getMessage());
            return redirect()->back();
        }
    }

    public function showProfile() {
        if(auth()->user()->role == 'Lembaga') {
            $this->param['data'] = DB::table('lembaga')
                ->join('users', 'users.id', 'lembaga.id_user')
                ->where('users.id', auth()->user()->id)
                ->select(
                    'users.username',
                    'users.email',
                    'lembaga.*'
                )
                ->first();
            return view('profile.lembaga', $this->param);
        } else if(auth()->user()->role == 'Petani') {
            $this->param['data'] = DB::table('petani')
                ->join('users', 'users.id', 'petani.id_user')
                ->where('users.id', auth()->user()->id)
                ->select(
                    'users.username',
                    'users.email',
                    'petani.*'
                )
                ->first();
            return view('profile.petani', $this->param);
        } else if(auth()->user()->role == 'Admin') {
            // return auth()->user();
            $this->param['data'] = auth()->user();
            return view('profile.admin', $this->param);
        } else {
            return redirect()->back();
        }
    }

    public function lihatSertifikat() {
        $this->param['data'] = DB::table('sertifikasi')
            ->join('petani', 'petani.id', 'sertifikasi.id_petani')
            ->join('template_sertifikasi', 'template_sertifikasi.id', 'sertifikasi.id_template_sertifikasi')
            ->join('lembaga', 'lembaga.id', 'template_sertifikasi.id_lembaga')
            ->where('petani.id_user', auth()->user()->id)
            ->select(
                'sertifikasi.*',
                'template_sertifikasi.sertifikasi',
                'petani.nama_petani',
                'lembaga.nama_lembaga'
            )
            ->orderBy('sertifikasi.id', 'desc')
            ->get();

        return view('profile.sertifikat', $this->param);
    }
}
