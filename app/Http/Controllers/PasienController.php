<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\JanjiPeriksa;

class PasienController extends Controller
{
    
    public function index(){
        $pasien = User::with([
            'janji_periksas.jadwal_periksas',
            'janji_periksas.periksa'
        ])->find(Auth::user()->id);

        return view('pasien.dashboard')->with(['pasien'=>$pasien]);
    }
}
