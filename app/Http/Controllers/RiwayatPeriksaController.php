<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JanjiPeriksa;
use App\Models\User;


class RiwayatPeriksaController extends Controller
{
    //
    public function index(){
        $janjis = JanjiPeriksa::with([
            'jadwal_periksas.dokter.poli',
            
        ])->whereHas('periksa')->
        where('id_pasien', Auth::user()->id)->get();

        return view('pasien.riwayat-periksa.index')->with([
            'janji_periksas'=>$janjis
        ]);
    }

    public function riwayat($id){
        $janji = JanjiPeriksa::with([
            'periksa'
        ])->find($id);

        return view('pasien.riwayat-periksa.riwayat')->with([
            'janji_periksa'=>$janji
        ]);
    }

    public function detail($id){
       $janji = JanjiPeriksa::with([
            'jadwal_periksas.dokter.poli'
       ])->find($id);
       
        return view('pasien.riwayat-periksa.detail')->with([
            'janji_periksa'=>$janji
        ]);
    }
}
