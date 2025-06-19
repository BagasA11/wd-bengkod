<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\JadwalPeriksa;
use App\Models\Obat;
use App\Models\JanjiPeriksa;
use App\Models\DetailPeriksa;


use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $janji_periksas = JanjiPeriksa::with([
            'periksa',
            'jadwal_periksas',
            'user'
        ])->get();
        return view('dokter.periksa.index')->with(['janji_periksas'=>$janji_periksas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        //
        
        $obats = Obat::all();
        $janji_periksa = JanjiPeriksa::with([
            'jadwal_periksas',
            'user'
        ])->find($id);

        if ($janji_periksa === NULL){
            session()->flash('error', 'janji periksa tidak ditemukan');
            return redirect()->route('dokter.memeriksa.index');
        }

        return view('dokter.periksa.create')->with([
            'obats'=>$obats,
            'janji_periksa' => $janji_periksa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id, Request $request)
    {
        //
        $validatedData = $request->validate([
            'tgl_periksa'=>'required|date',
            'obats'=>'array',
            'obats.*'=>'exists:obats,id',
            'biaya'=>'required|numeric|min:0',
            'catatan'=>'required'
        ]);

        if (JanjiPeriksa::find($id) === NULL){
            session()->flash('error', 'id janji periksa tidak ditemukan');
            return redirect()->route('dokter.memeriksa.periksa');
        }

        $periksa = Periksa::create([
            'tgl_periksa'=>$validatedData['tgl_periksa'],
            'added_at'=>date("Y-m-d H:i:s"),
            'biaya'=>$validatedData['biaya'],
            'catatan'=>$validatedData['catatan'],
            'id_janji_periksa'=>$id
        ]);

       foreach ($validatedData['obats'] as $obatID) {
            DetailPeriksa::create([
                'id_periksa'=>$periksa->id,
                'id_obat'=>$obatID
            ]);
       }
        session()->flash('success', 'periksa berhasil dibuat');
        return redirect()->route('dokter.memeriksa.index');
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
     * show list of all obat
     * show janji_periksa with hasOne Periksa, and periksa hasMany detail_periksa, and detail periksa is belongs to obats
     */
    public function edit(string $id)
    {
        //
        $obats = Obat::all();
        $janji_periksa = JanjiPeriksa::with([
            'periksa.detail_periksa.obat',
            'user',
            'jadwal_periksas'
        ])->find($id);
        
        return view('dokter.periksa.edit')->with([
            'obats'=>$obats,
            'janji_periksa'=>$janji_periksa
        ]); 
    }

    public function detail($id){
        $janji = JanjiPeriksa::with([
            'periksa.detail_periksa.obat',
            'user',
        ])->find($id);
        return view('dokter.periksa.detail')->with([
            'janji_periksa'=>$janji,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'tgl_periksa'=>'required|date',
            'obats'=>'array',
            'obats.*'=>'exists:obats,id',
            'biaya'=>'required|numeric|min:0',
            'catatan'=>'required'
        ]);

        $periksa = Periksa::where('id_janji_periksa',$id)->first();
        $periksa->update([
            'tgl_periksa' => $validatedData['tgl_periksa'],
            'biaya'=>$validatedData['biaya'],
            'catatan'=>$validatedData['catatan']

        ]);
        DetailPeriksa::where('id_periksa', $periksa->id)->delete();
        foreach($validatedData['obats'] as $obatID){
            DetailPeriksa::create([
                'id_periksa'=>$periksa->id,
                'id_obat'=>$obatID
            ]);
        }
        return redirect()->route('dokter.memeriksa.index'); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
