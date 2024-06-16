<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    //
    public function register(Request $request){
        // check email
        $user_find = User::where('email', $request->email)->first();
        if ($user_find) {
            return redirect()->route('register')->with('error', 'email telah digunakan!')->withInput();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
        }

        $data_request = 
        [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
        ];

        $user = User::create($data_request);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('login');

    }

    public function login(Request $request)
    {
    // Validasi input dari pengguna
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ]);

    // Coba autentikasi pengguna
    if (Auth::attempt($credentials)) {
        // Regenerasi sesi untuk mencegah serangan session fixation
        $request->session()->regenerate();

        // Redirect ke dashboard
        return redirect()->intended('dashboard');
    }

    // Jika autentikasi gagal, kembali ke halaman login dengan error
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput($request->except('password'));
    }


    public function logout(){
        Auth::logout();

        return redirect()->route('login');
    }

    public function detail_profile(){
        $data = [
            'title' => 'detail profile',
            'user' => Auth::user()
        ];

        return view('auth.profile', $data);
    }

    public function edit_profile(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
           ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();

        return redirect()->back()->with('success', 'data berhasil di ubah !');

    }
    
}
