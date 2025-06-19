<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan semua data obat
        $obats = Obat::all();
        return view('dokter.obat.index')->with([
            'obats'=>$obats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dokter.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //menyimpan data insert
         $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga'    => 'required|numeric|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-created');
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
        // $obat = Obat::find($id)->first();
        $obat = Obat::find($id);
        // return view('dokter.obat.edit')->with(['obat'=>obat]);
        return view('dokter.obat.edit')->with([
            'obat' => $obat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nama_obat'=> ['required', 'string', 'max:255'],
            'kemasan'=> ['required', 'string', 'max:255'],
            'harga'=> ['required', 'min:0'],
        ]);

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softdelete(string $id)
    {
        //
        $obat = Obat::find($id);
        $obat->delete();

        return redirect()->route('dokter.obat.index')->with('status', 'obat-deleted');
    }

    public function trash(){
        $obats = Obat::onlyTrashed()->get();
        return view('dokter.obat.trash')->with(['obats'=>$obats]);
    }

    public function recover(string $id){
         $obats = Obat::onlyTrashed()->find($id);;
         if ($obats) {
            $obats->restore();
            return redirect()->route('dokter.obat.trash')->with('status', 'obat-recovered');
        } else {
            return redirect()->route('dokter.obat.trash')->with('error', 'Obat tidak ditemukan atau belum dihapus.');
        }
    }

    public function forceDelete($id){
         $obats = Obat::onlyTrashed()->find($id);
         $obats->forceDelete();
         return redirect()->route('dokter.obat.trash');
    }
}
