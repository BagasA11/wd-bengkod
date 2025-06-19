<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalPeriksa;
use App\Models\JanjiPeriksa;
use App\Models\User;

class JanjiPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
        
    // }

    public function index()
    {
        $no_rm = Auth::user()->no_rm;
        $dokters = User::with([
            'jadwal_periksas' => function ($query) {
                $query->where('status', true);
            },
        ])
            ->where('role', 'dokter')
            ->get();
        // dd($dokters->jadwal_periksas());
        return view('pasien.janji-periksa.index')->with([
            'no_rm' => $no_rm,
            'dokters' => $dokters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required',
        ]);

        $jumlahJanji = JanjiPeriksa::where('id_jadwal_periksa', $validatedData['id_jadwal_periksa'])->count();
        $noAntrian = $jumlahJanji + 1;

        JanjiPeriksa::create([
            'id_pasien' => Auth::user()->id,
            'id_jadwal_periksa' => $validatedData['id_jadwal_periksa'],
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return redirect()->route('pasien.janji-periksa.index')->with('status', 'janji-periksa-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $jadwal_periksas = JadwalPeriksa::with('dokter')->where('status', true)->get();
        $janji_periksa = JanjiPeriksa::find($id);
        // dd($jadwal_periksas);
        return view('pasien.janji-periksa.edit')->with([
            'jadwal_periksas'=>$jadwal_periksas,
            'janji_periksa'=>$janji_periksa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required',
        ]);

        JanjiPeriksa::where('id', $id)->update([
            'id_jadwal_periksa' => $request->id_jadwal_periksa,
            'keluhan' => $request->keluhan
        ]);

        session()->flash('success', 'janji periksa berhasil di update');
        return redirect()->route('pasien.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function cancel(string $id)
    {
        $janji = JanjiPeriksa::with('periksa')->find($id);
        if(optional($janji->periksa)->exists()){
            session()->flash('error', 'tidak bisa membatalkan janji yang disetujui oleh dokter');
            return redirect()->route('pasien.dashboard');
        } else {
            $janji->delete();
            session()->flash('success', 'janji dibatalkan');
            return redirect()->route('pasien.dashboard');
        }
    }
}
