<?php

namespace App\Http\Controllers;
use App\Models\Sip;
use Illuminate\Http\Request;

class SipController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Sip::select("sertifikasi_keamanan as value", "id")
                    ->where('sertifikasi_keamanan', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function show(Sip $sip)
    {
        return response()->json($sip);
    }

}
