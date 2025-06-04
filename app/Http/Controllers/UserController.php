<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Rules\EmailDomain;
use App\Models\User;

class UserController extends Controller
{
    //
    public function registerPage(){
        return view('auth.register');
    }
   
    public function createUser(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,', new EmailDomain],
            'address'=>['required', 'string'],
            'nik' => ['required', 'string', 'max:255', 'unique:users,nik,'],
            'no_hp' => ['required', 'string', 'max:255', 'unique:users,no_hp,'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ]);

        $user = new User();

        $user->name=$validated['name'];
        $user->email=$validated['email'];
        $user->address=$validated['address'];
        $user->no_hp=$validated['no_hp'];
        $user->nik=$validated['nik'];
        $user->password=$validated['password'];
        $user->role='pasien';
        $user->no_rm=$user->no_rm();

        $user->save();
        // var_dump($validated);
        return redirect()->route('login');
    }
}
