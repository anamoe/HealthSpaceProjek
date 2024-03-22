<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function postregister(Request $request)
    {
        $input = $request->all();

        $rules = [

            'password'  => 'required',
            'email'  => 'required',

        ];
        // error message untuk validasi
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];
        // instansiasi validator
        $validator = Validator::make($request->all(), $rules, $message);

        // proses validasi
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        // if ($request->password != $request->kpassword) {
        //     return redirect()->back()->with('error', 'Password tidak sama');
        // }

        if (User::where('email', '=', $input['email'])->first() == false) {
            $request->merge([
                'role' => 'pasien',
                'password' => bcrypt($request->password),
                'email' => $request->email,

            ]);
         $user=   User::create($request->except(['_token']));
            Pasien::create([
                'user_id'=>$user->id
            ]);

            return redirect('login')->with('message', 'Berhasil Mendaftar');
            // return $i;
        } else {
            // return "eror";
            return redirect()->back()->with('errorr', 'Email sudah terdaftar');
        }
    }
    public function postlogin(Request $request)
    {

        $input = $request->all();

        $rules = [

            'email'     => 'required',
            'password'  => 'required',


        ];
        // error message untuk validasi
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];
        // instansiasi validator
        $validator = Validator::make($request->all(), $rules, $message);

        // proses validasi
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        if (User::where('email', '=', $input['email'])->first() == true) {
            if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

                switch (Auth::user()->role) {
                    case 'admin':

                        return redirect('/admin/dashboard')->with('success', 'Berhasil Login');
                        break;
                    case 'pasien':

                        return redirect('/pasien/dashboard')->with('success', 'Berhasil Login');
                        break;
                    case 'dokter':

                        return redirect('/dokter/dashboard')->with('success', 'Berhasil Login');
                        break;
                    default:
                        return redirect('/login');
                        break;
                }
            } else {
                return redirect()->back()
                    ->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()
                ->with('error', 'Email tidak ada atau belum terdaftar');
        }
        // }
    }

    public function login()
    {
        if (auth()->check()) {
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                    break;
                case 'pasien':
                    return redirect('/pasien/dashboard');
                    break;
                case 'dokter':
                    return redirect('/dokter/dashboard');
                    break;
                default:
                    return redirect('/login');
                    break;
            }
        }
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function profil_pasien(){
        $users =DB::table('pasiens')
        ->leftJoin('users','pasiens.user_id','users.id')
        ->select('users.*','pasiens.*')
        ->where('pasiens.user_id',auth()->user()->id)
        ->orderBy('pasiens.id','desc')->first();
        $users->profil = asset('profil/'.$users->profil);
        // return $users;

        return view('pasien.profil-pasien',compact('users'));
    }

    public function profil_pasien_update(Request $request,$id){

        
        $data0 = $request->validate([
            'nama'=>'required',
            // 'email'=>'required',    
        
        ]);
        
        $data = $request->validate([
            'tanggal_lahir'=>'required',
            'alamat'=>'required',
            'berat_badan'=>'required',
            'tinggi_badan'=>'required',
            'no_telp'=>'required',
            'jenis_kelamin'=>'required',
        
        ]);

        if($request->hasFile('foto')){
            $tujuan_upload = public_path('profil');
            $file = $request->file('foto');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            // return $file;
            $data0['profil'] = $namaFile;
        }
    
       $pasien = Pasien::where('id',$id)->first();


    //    if($request->password){
    //     $data0['password']=bcrypt($request->password);
    //     // return $request;
    // }
        $pasien->update($data);
      
        // return $req;
    
        User::where('id',$pasien->user_id)->update($data0);
   
        
        return redirect('pasien/profil-pasien')
        ->with('success',' Profil Pasien Berhasil Diupdate');

    }
}
