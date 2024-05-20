<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'role' => $data['role']
        ]);
    }

    public function register(Request $request) {
        DB::beginTransaction();
        event(new Registered($user = $this->create($request->all())));
        try  {
            if($request->role == 'Lembaga') {
                // Upload Akreditasi
                if($request->file('bukti_akreditasi') != null) {
                    $fileAkreditasi = $request->file('bukti_akreditasi');
                    $filenameAkreditasi = $fileAkreditasi->getClientOriginalName();
                    $filePathAkreditasi = public_path() . '/upload/' . 'dokumen-users/lembaga/' . $user->id . '/bukti-akreditasi';
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
                    $filePathFoto = public_path() . '/upload/' . 'dokumen-users/lembaga/' . $user->id . '/bukti-Foto';
                    if(!File::isDirectory($filePathFoto)) {
                        File::makeDirectory($filePathFoto, 493, true);
                    }
                    $fileFoto->move($filePathFoto, $filenameFoto);
                } else {
                    $filenameFoto = null;
                }
                
                $idLembaga = DB::table('lembaga')
                    ->insertGetId([
                        'nama_lembaga' => $request->name,
                        'tahun_berdiri' => $request->tahun_berdiri,
                        'status_verifikasi' => 0,
                        'alamat_lembaga' => $request->alamat,
                        'no_hp_lembaga' => $request->no_hp,
                        'deskripsi_lembaga' => $request->deskripsi,
                        'id_user' => $user->id,
                        'bukti_akreditasi' => $filenameAkreditasi != null ? 'dokumen-users/lembaga/' . $user->id . '/bukti-akreditasi/' . $filenameAkreditasi : null,
                        'foto_lembaga' => $filenameFoto != null ? 'dokumen-users/lembaga/' . $user->id . '/bukti-foto/' . $filenameFoto : null,
                    ]);
                
                $dataSertifikasi = [];
                foreach ($request->nama_sertifikat as $key => $item) {
                    if($item != null) {
                        // Dokumen upload
                        $file = $request->file('kebutuhan_sertifikat')[$key];
                        $filename = $file->getClientOriginalName();
                        $filePath = public_path() . '/upload/' . 'dokumen-sertifikasi/' . $idLembaga . '/' . $item;
                        if(!File::isDirectory($filePath)) {
                            File::makeDirectory($filePath, 493, true);
                        }
                        $file->move($filePath, $filename);

                        array_push($dataSertifikasi, [
                            'sertifikasi' => $item,
                            'id_lembaga' => $idLembaga,
                            'masa_berlaku' => $request->masa_berlaku[$key],
                            'template_sertifikasi' => 'dokumen-sertifikasi/' . $idLembaga . '/' . $item . '/' . $filename,
                            'created_at' => now()
                        ]);
                    }
                }

                if(count($dataSertifikasi) > 0) {
                    DB::table('template_sertifikasi')
                        ->insert($dataSertifikasi);
                }
            } else if ($request->role == 'Petani') {
                DB::table('petani')
                    ->insert([
                        'nama_petani' => $request->name,
                        'jenis_petani' => $request->jenis_petani,
                        'alamat_petani' => $request->alamat,
                        'no_hp_petani' => $request->no_hp_petani,
                        'id_user' => $user->id
                    ]);
            }
            DB::commit();
            $this->guard()->login($user);
        
            Alert::success('Berhasil.', 'Data tersimpan. Akun berhasil dibuat, selamat datang')->autoClose(10000);
            return $this->registered($request, $user)
                       ?: redirect($this->redirectPath());
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
