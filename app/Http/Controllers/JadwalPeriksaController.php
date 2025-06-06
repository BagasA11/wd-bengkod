<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;

use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dokterID = Auth::user()->id;
        $jadwal_periksas =  JadwalPeriksa::where('id_dokter', $dokterID)->get();
        return view('dokter.jadwal-periksa.index')->with(['jadwals'=>$jadwal_periksas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        return view('dokter.jadwal-periksa.create')->with(['days'=>$days]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request, $userID)
    // {
    //     //
    //     dd($request);
    // }
    
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'hari'=> 'required|string',
            'jam_mulai'=> 'required|date_format:H:i',
            'jam_selesai'=> 'required|date_format:H:i|after:jam_mulai',
        ]);

        if (JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('hari', $validated['hari'])->where('jam_mulai', $validated['jam_mulai'])
            ->where('jam_selesai', $validated['jam_selesai'])->exists()
        ){
            return redirect()->route('dokter.jadwal-periksa.index');
        } else{
            JadwalPeriksa::create([
                'hari'=>$validated['hari'],
                'id_dokter'=>Auth::user()->id,
                'jam_mulai'=>$validated['jam_mulai'],
                'jam_selesai'=>$validated['jam_selesai'],
                'status'=>false
            ]);
            return redirect()->route('dokter.jadwal-periksa.index');
        }
       
        // JadwalPeriksa::create([
        //     'hari'=>$validated['hari'],
        //     'id_dokter'=>Auth::user()->id,
        //     'jam_mulai'=>$validated['jam_mulai'],
        //     'jam_selesai'=>$validated['jam_selesai'],
        //     'status'=>false
        // ]);
        // return redirect()->route('dokter.jadwal-periksa.index');
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
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    public function enable(string $id){ 
        // JadwalPeriksa::where('id', $id)->update(['status'=>true]);
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::user()->id)->find($id);
        $jadwal->status = true;
        // $dokterID = $jadwal->dokter()
        $jadwal->save();
        return redirect()->route('dokter.jadwal-periksa.index', Auth::user()->id);
    }

    public function disable(string $id){ 
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::user()->id)->find($id);
        $jadwal->status = false;
        $jadwal->save();
        return redirect()->route('dokter.jadwal-periksa.index', Auth::user()->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::user()->id)->find($id);
        // $idDokter = $jadwal->dokter()->id;
        $jadwal->delete();
        return redirect()->route('dokter.jadwal-periksa.index', Auth::user()->id);
    }
}
