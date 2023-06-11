<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Sip;
use App\Models\SipDetail;
use Illuminate\Http\Request;

class SipController extends Controller
{
    public function index()
    {   
        $title = "Data SATPAM";
        $satpams = SATPAM::orderBy('id','asc')->paginate(5);
        return view('satpams.index', compact(['satpams' , 'title']));
    }

    public function create()
    {
        $title = "Tambah Data SATPAM";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('satpams.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_satpam' => 'required'
        ]);
        
        $satpam = [
            'no_satpam' => $request->no_satpam,
            'nama_satpam' => $request->nama_satpam,
            'no_hp' => $request->no_hp,
            'bahasa' => $request->bahasa,
            // 'total' => $request->total,
        ];
        if ($result = Satpam::create($satpam)){
            for ($i=1; $i <= $request->jml; $i++) { 
                $details = [
                    'no_satpam' => $request->no_satpam,
                    'nama_satpam' => $request['nama_satpam'.$i],
                    'tempat_jaga' => $request['tempat_jaga'.$i],
                    'hari_jaga' => $request['hari_jaga'.$i],
                ];
                Detail::create($details);
            }
        }
        return redirect()->route('satpams.index')->with('success','Satpam has been created successfully.');
    }

    public function show(Satpam $satpam)
    {
        return view('satpams.show',compact('Departement'));
    }

    public function edit(Satpam $satpam)
    {
        $title = "Edit Data Satpam";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        $detail = Detail::where('no_satpam', $satpam->no_satpam)->orderBy('id','asc')->get();
        return view('satpams.edit',compact('satpam' , 'title', 'managers', 'sip__detail'));
    }

    public function update(Request $request, Satpam $satpam)
    {
        $satpams = [
            'no_satpam' => $request->no_satpam,
            'nama_satpam' => $request->nama_satpam,
            'no_hp' => $request->no_hp,
            'bahasa' => $request->bahasa,
            // 'total' => $request->total,
        ];
        if ($satpam->fill($satpams)->save()){
            Detail::where('no_satpam', $satpam->no_satpam)->delete();
            for ($i=1; $i <= $request->jml; $i++) { 
                $details = [
                    'no_satpam' => $satpam->no_satpam,
                    'nama_satpam' => $request['nama_satpam'.$i],
                    'jam_jaga' => $request['jam_jaga'.$i],
                    'no_hp' => $request['no_hp'.$i],
                    'bahasa' => $request['bahasa'.$i],
                    'tempat_jaga' => $request['tempat_jaga'.$i],
                    'hari_jaga' => $request['hari_jaga'.$i],
                ];
                Detail::create($details);
            }
        }
        return redirect()->route('satpams.index')->with('success','Departement Has Been updated successfully');
    }

    public function destroy(Satpam $satpam)
    {
        $satpam->delete();
        return redirect()->route('satpams.index')->with('success','Departement has been deleted successfully');
    }

}