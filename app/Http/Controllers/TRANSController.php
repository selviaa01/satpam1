<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\TRANS;
use App\Models\TRANSDetail;
use Illuminate\Http\Request;

class TRANSController extends Controller
{
    public function index()
    {   
        $title = "Data TRANS";
        $s = TRANS::orderBy('id','asc')->paginate(5);
        return view('transs.index', compact(['transs' , 'title']));
    }

    public function create()
    {
        $title = "Tambah Data TRANS";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('transs.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'keterangan',
            'alias',
        ]);
        
        TRANS::create($request->post());

        return redirect()->route('transs.index')->with('success','TRANS has been created successfully.');
    }

    public function show(TRANS $trans)
    {
        return view('transs.show',compact('TRANS'));
    }

    public function edit(TRANS $trans)
    {
        $title = "Edit Data TRANS";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('transs.edit',compact('TRANS' , 'title', 'managers'));
    }

    public function update(Request $request, TRANS $trans)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);
        
        $trans->fill($request->post())->save();

        return redirect()->route('transs.index')->with('success','TRANS Has Been updated successfully');
    }

    public function destroy(TRANS $trans)
    {
        $trans->delete();
        return redirect()->route('transs.index')->with('success','TRANS has been deleted successfully');
    }

}
