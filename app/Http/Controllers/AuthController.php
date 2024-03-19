<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


        if ($request->password != $request->kpassword) {
            return redirect()->back()->with('error', 'Password tidak sama');
        }

        if (User::where('email', '=', $input['email'])->first() == false) {
            $request->merge([
                'role' => 'pasien',
                'password' => bcrypt($request->password),
                'email' => $request->email,

            ]);
            User::create($request->except(['_token']));

            return redirect('login')->with('message', 'Berhasil Mendaftar');
            // return $i;
        } else {
            // return "eror";
            return redirect()->back()->with('error', 'Email sudah terdaftar');
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
}
