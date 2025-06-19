<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DetailPeriksa;

class DetailPeriksaController extends Controller
{
    //
    public function destroy($id){
        $detail = DetailPeriksa::find($id);
        if ($detail === NULL){
            session()->flash('error', 'janji periksa tidak ditemukan');
            return redirect()->route('dokter.memeriksa.edit');
        }
        $detail->delete();
        session()->flash('error', 'janji periksa tidak ditemukan');
        return redirect()->route('dokter.memeriksa.edit');
    }
}
