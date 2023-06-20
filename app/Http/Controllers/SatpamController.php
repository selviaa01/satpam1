<?php

namespace App\Http\Controllers;
use App\Models\SipDetail;
use App\Models\Satpam;
use App\Models\User;
use Illuminate\Http\Request;
use App\Charts\SipLineChart;
use PDF;

class SatpamController extends Controller
{
    public function index()
    {   
        $title = "Data Satpam";
        $satpams = Satpam::orderBy('id','asc')->get();
        return view('satpams.index', compact(['satpams' , 'title']));
    }

    public function create()
    {
        $title = "Tambah Data Satpam";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('satpams.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_satpam' => 'required'
        ]);

        $satpam = [
            'kd_satpam' => $request->kd_satpam,
            'nama_satpam' => $request->nama_satpam,
            'tgl_jaga' => $request->tgl_jaga,
    
        ];
        if($result = Satpam::create($satpam)){
            for ($i=1; $i <= $request->jml; $i++) { 
                $details = [
                    'kd_satpam' => $request->kd_satpam,
                    'kd_sip' => $request['kd_sip'.$i],
                    'tempat_jaga' => $request['tempat_jaga'.$i],
                    'seragam_jaga' => $request['seragam_jaga'.$i],
                ];
                SipDetail::create($details);
            }
        }
        return redirect()->route('satpams.index')->with('success','Satpam has been created successfully.');
    }

    public function show(Satpam $satpam)
    {
        return view('satpams.show',compact('Satpam'));
    }

    public function edit(Satpam $satpam)
    {
        $title = "Edit Data Satpam";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        $detail = SipDetail::where('kd_satpam', $satpam->kd_satpam)->orderBy('id','asc')->get();
        return view('satpams.edit',compact('satpam' , 'title', 'managers'));
    }

    public function update(Request $request, Satpam $satpam)
    {
        $satpam->kd_satpam = $request->kd_satpam;
        $satpam->nama_satpam = $request->nama_satpam;
        $satpam->nama_satpam = $request->nama_satpam;
        $satpam->tgl_jaga = $request->tgl_jaga;
      
        if ($satpam->fill($satpams)->save()){
            SipDetail::where('kd_satpam', $satpam->kd_satpam)->delete();
            for ($i=1; $i <= $request->jml; $i++) { 
                $details = [
                    'kd_satpam' => $satpam->kd_satpam,
                    'kd_sip' => $request['kd_sip'.$i],
                    'nama_satpam' => $request['nama_satpam'.$i],
                    'tgl_jaga' => $request['tgl_jaga'.$i],
                    'tempat_jaga' => $request['tempat_jaga'.$i],
                    'seragam_jaga' => $request['seragam_jaga'.$i],
                ];
                SipDetail::create($details);
            }
        }
        return redirect()->route('satpams.index')->with('success','Satpam Has Been updated successfully');
    }

    public function destroy(Satpam $satpam)
    {
        $satpam->delete();
        return redirect()->route('satpams.index')->with('success','Satpam has been deleted successfully');
    }

    public function exportPdf()
    {
        $title = "Laporan Data Satpam";
        $sips = Sip::orderBy('id', 'asc')->get();

        $pdf = PDF::loadview('sips.pdf', compact(['sips', 'title']));
        return $pdf->stream('laporan-sips-pdf');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLine()
    {
        $api = url('sips.chartLineAjax');
   
        $chart = new SatpamLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
        $title = "Chart Ajax";  
        return view('home', compact('chart','title'));
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $sips = Sip::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('tgl_jaga', 'LIKE', '%'.$year)
                    ->groupBy(\DB::raw("Month(tgl_jaga)"))
                    ->pluck('count');
  
        $chart = new SipLineChart;
  
        $chart->dataset('New Sip Register Chart', 'line', $sips)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart->api();
    }
}
