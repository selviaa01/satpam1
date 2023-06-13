<?php

namespace App\Http\Controllers;
use App\Models\Satpam;
use Illuminate\Http\Request;

class SatpamController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Satpam::select("sertifikasi_keamanan as value", "id")
                    ->where('sertifikasi_keamanan', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    
    public function show(Satpam $satpam)
    {
        return response()->json($satpam);
    }

}