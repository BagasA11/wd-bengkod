<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JanjiPeriksa;

class PasienController extends Controller
{
    
    public function index(){
        $janji_periksas = JanjiPeriksa::with([
            'jadwal_periksas', 
            ])->
            where('id_pasien', Auth::user()->id)->
            whereDoesntHave('periksa')->get();

        return view('pasien.dashboard')->with(['janji_periksas'=>$janji_periksas]);
    }
}
