<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Poli;

class DokterController extends Controller
{
    //
    public function index(){
        $dokter = User::with(['poli'])->find(Auth::user()->id);
        // dd($poli);
        return view('dokter.dashboard')->with(['dokter'=>$dokter]);
    }
}
