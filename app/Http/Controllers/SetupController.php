<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\District;
use App\Models\DptModel;
use App\Models\Paslon;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SetupController extends Controller
{

    public function __construct()
    {
        $config = Config::all()->first();

        if ($config['setup'] == "no") {
            redirect('index');
        }
    }

    public function setup_kota()
    {
        $config = Config::all()->first();
        if ($config['provinces_id'] == NULL) {
            $province = Province::all();
            return view('setup.kota', ['province' => $province]);
        } else {
            return redirect('setup_paslon');
        }
    }
    public function setup_logo(Request $request)
    {
        $input = request()->all();
        $validatedData = $request->validate([
            'province' => 'required',
            'regency' => 'required',
        ], [
            'province.required' => 'Provinsi Wajib di isi',
            'regency.required' => 'Kota Wajib di isi'
        ]);

        $setup =  Config::where('id', 1)->update(
            [
                'provinces_id' => $input['province'],
                'regencies_id' => $input['regency'],
            ]
        );

        if ($setup) {
            return redirect('setup_paslon');
        } else {
            abort(403, 'ENC-2938291.');
        }
    }

    public function setup_logo_paslon()
    {
        return view('setup.logo');
    }

    public function setup_logo_action(Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'image2' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $images = $request->file('image')->store('logo');
        $images2 = $request->file('image2')->store('logo');
        $setup =  Config::where('id', 1)->update(
            [
                'regencies_logo' => $images,
                'partai_logo' => $images2,
            ]
        );
        return redirect('setup_paslon');
    }
    public function setup_paslon()
    {
        $config = Paslon::all();
        $count = count($config);
        return view('setup.paslon',
            [
                'count' => $count,
                'candidate' => $config,
            ]
        );
    }

    public function setup_paslon_action(Request $request)
    {
        $input = request()->all();
        $validatedData = $request->validate([
            'img_candidate' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
           
        ], [
            'img_candidate.required' => 'Foto kandidat Wajib Di isi',
        ]);
        $images = $request->file('img_candidate')->store('candidate');

        $candidate = new Paslon;
        $candidate->candidate = $input['candidate'];
        
        $candidate->deputy_candidate = $input['d_candidate'];
        $candidate->color = 'bg-success-gradient';
        $candidate->picture = $images;
        $candidate->save();

        return redirect('setup_paslon');
      
    }

    public function setup_dpt()
    {     
        $course = Config::find(1)->regencies;
        $courses = Regency::find($course['id'])->districts;
        // return view('setup.dpt',[
        //     'district' => $courses,
        // ]);
        return redirect('setup_tps');
    }

    public function action_setup_dpt(Request $request)
    {
        $input = $request->all();
        $course = Config::find(1)->regencies;
        $courses = Regency::find($course['id'])->districts;
        
        foreach ($courses as $cs) {
            $setup =  District::where('id', $cs['id'])->update(
                [
                    'dpt' => $input[$cs['id']],  
                ]
            );
            // if ($setup) {
            //     echo 'ok';
            // }else{
            //     echo 'gagal';
            // }
        }
        return redirect('setup_tps');
    }
    
    public function setup_tps()
    {
      $config   = Config::find(1)->with('regencies')->get();
        $frcfg    = $config[0]->regencies;
        $regency  = District::where('regency_id',$frcfg['id'])->where('status','no')->first();
        $regency_count  = District::where('regency_id',$frcfg['id'])->get();
        $regency_sisa  = District::where('regency_id',$frcfg['id'])->where('status','solve')->get();

        $jumlah = count($regency_sisa) + 1;


        if ($regency == NULL) {
            return redirect('selesai_tps');
        }else{
            $village  = Village::where('district_id',$regency['id'])->get();
            return view('setup.tps',[
                'kecamatan' => $regency,
                'kelurahan' => $village,
                'count_kecamatan' => $regency_count,
                'sisa_count' =>  $jumlah,
            ]);
        }
    }

    public function action_setup_tps(Request $request,$id)
    {
        $input = $request->all();
        $district  = District::where('id',$id)->first();
        $village  = Village::where('district_id',$id)->get();

       
        foreach ($village as $vg) {
            $villages_update = Village::where('id',$vg['id'])->update(
                [
                    'tps' => $input[$vg['id']],
                    
                ]
                );
            for ($x = 1; $x <=  $input[$vg['id']]; $x++) {
               $tps = new Tps;
               $tps->district_id = $id;
               $tps->villages_id = (string) $vg['id'];
               $tps->number      = $x;
               $tps->setup      = "belum terisi";
               $tps->save();
            }

            
            DptModel::create([
                'districts_id' =>  $id,
                'villages_id' => $vg['id'],
                'count'       =>  $input['dpt-'.$vg['id'].'']
            ]);
        }

        $dpt = DptModel::where('districts_id',$id)->sum('count');
        $district_update = District::where('id',$id)->update(
            [
                'status' => 'solve',
                'dpt'    =>  $dpt,
               
            ]
        );

        
       
        return redirect('setup_tps');
     
    }

    public function selesai_tps()
    {
        ini_set('max_execution_time', 0);
		ini_set('memory_limit', '4048M');
        $config = Config::first();
        $total_tps = Tps::join('districts','tps.district_id','=','districts.id')->where('districts.regency_id',$config->regencies_id)->get();
        $persen = 10 / 100 * count($total_tps);
		$sampleTps = Tps::inRandomOrder()->limit($persen)->get();
		foreach ($sampleTps as $tps) {
			Tps::where('id',$tps['id'])->update([
                'sample' => 1,
            ]);
		}
        // DB::table('tps')->update([
        //           'sample' => null,
        //     ]);
        // Config::where('id',1)->update([
        //     'setup' => 'no',
        // ]);
        return redirect('setup_done');
    }

    public function setup_done()
    {
       $config = Config::where('id',1)->update(
           [
               'setup' => 'no',
           ]
           );
           return redirect('/');
    }

    private function TpsQuick($persen)
    {
        $config = Config::find(1);
        $limit =  $this->hitungTpsPerKota($config['regencies_id']) * $persen / 100;

       dd($limit);
    }

    private function hitungTpsPerKota($id_kab)
	{
        $tps = Tps::join('districts','districts.id','=','tps.district_id')
        ->join('regencies','regencies.id','=','districts.regency_id')
        ->where('districts.regency_id',$id_kab)
        ->count();
         return count($tps);
	
	}
}
