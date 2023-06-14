<?php

namespace App\Http\Controllers;
use App\Models\Sip;
use Illuminate\Http\Request;

class SipController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Sip::select("sesi_jaga as value", "id")
                    ->where('sesi_jaga', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function show(Sip $sip)
    {
        return response()->json($sip);
    }
}
