<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sip;
use App\Models\SipDetail;
use App\Charts\SipLineChart;
use Illuminate\Http\Request;

class SipController extends Controller
{
    public function index()
    {
        $title = "Data SIP";
        $sips = Sip::orderBy('id', 'asc')->paginate(5);
        return view('sips.index', compact('sips', 'title'));
    }

    public function create()
    {
        $title = "Tambah Data SIP";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        return view('sips.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_satpam' => 'required'
        ]);

        $sip = new Sip();
        $sip->no_satpam = $request->no_satpam;
        $sip->nama_satpam = $request->nama_satpam;
        $sip->no_hp = $request->no_hp;
        $sip->bahasa = $request->bahasa;
        $sip->save();

        for ($i = 1; $i <= $request->jml; $i++) {
            $detail = new SipDetail();
            $detail->no_satpam = $request->no_satpam;
            $detail->nama_satpam = $request['nama_satpam'.$i];
            $detail->tempat_jaga = $request['tempat_jaga'.$i];
            $detail->hari_jaga = $request['hari_jaga'.$i];
            $detail->save();
        }

        return redirect()->route('sips.index')->with('success', 'Sip has been created successfully.');
    }

    public function show(Sip $sip)
    {
        return view('sips.show', compact('sip'));
    }

    public function edit(Sip $sip)
    {
        $title = "Edit Data Sip";
        $managers = User::where('position', '1')->orderBy('id', 'asc')->get();
        $details = SipDetail::where('no_satpam', $sip->no_satpam)->orderBy('id', 'asc')->get();
        return view('sips.edit', compact('sip', 'title', 'managers', 'details'));
    }

    public function update(Request $request, Sip $sip)
    {
        $request->validate([
            'no_satpam' => 'required'
        ]);

        $sip->no_satpam = $request->no_satpam;
        $sip->nama_satpam = $request->nama_satpam;
        $sip->no_hp = $request->no_hp;
        $sip->bahasa = $request->bahasa;
        $sip->save();

        SipDetail::where('no_satpam', $sip->no_satpam)->delete();
        for ($i = 1; $i <= $request->jml; $i++) {
            $detail = new SipDetail();
            $detail->no_satpam = $sip->no_satpam;
            $detail->nama_satpam = $request['nama_satpam'.$i];
            $detail->jam_jaga = $request['jam_jaga'.$i];
            $detail->no_hp = $request['no_hp'.$i];
            $detail->bahasa = $request['bahasa'.$i];
            $detail->tempat_jaga = $request['tempat_jaga'.$i];
            $detail->hari_jaga = $request['hari_jaga'.$i];
            $detail->save();
        }

        return redirect()->route('sips.index')->with('success', 'Sip has been updated successfully');
    }

    public function destroy(Sip $sip)
    {
        $sip->delete();
        return redirect()->route('sips.index')->with('success', 'Sip has been deleted successfully');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLine()
    {
        $api = url('sips.chartLineAjax');
   
        $chart = new SipLineChart;
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
                    ->whereYear('tgl_jaga', $year)
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
