<?php

namespace App\Http\Controllers;
use App\Models\Satpam;
use Illuminate\Http\Request;

class SatpamController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Satpam::select("name as value", "id")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }
}