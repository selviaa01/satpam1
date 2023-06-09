<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\SIP;
use App\Models\SIPDetail;
use Illuminate\Http\Request;

class SIPController extends Controller
{
    public function index()
    {   
        $title = "Data SIP";
        $sips = SIP::orderBy('id','asc')->paginate(5);
        return view('sips.index', compact(['sips' , 'title']));
    }

    public function create()
    {
        $title = "Tambah Data SIP";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('sips.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satpam' => 'required'
        ]);
        
        SIP::create($request->post());

        return redirect()->route('sips.index')->with('success','SIP has been created successfully.');
    }

    public function show(SIP $sip)
    {
        return view('sips.show',compact('SIP'));
    }

    public function edit(SIP $sip)
    {
        $title = "Edit Data SIP";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('sips.edit',compact('SIP' , 'title', 'managers'));
    }

    public function update(Request $request, SIP $sip)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);
        
        $sip->fill($request->post())->save();

        return redirect()->route('sips.index')->with('success','SIP Has Been updated successfully');
    }

    public function destroy(SIP $sip)
    {
        $sip->delete();
        return redirect()->route('sips.index')->with('success','SIP has been deleted successfully');
    }

}
