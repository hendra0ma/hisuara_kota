<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RelawanController extends Controller
{
    public function uploadC1Relawan(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'c1_images' => 'required|mimes:png,jpg|max:2048',
        ]);

        $config = Config::first();
        $user  = Auth::user();

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if ($files = $request->file('c1_images')) {
            $file =  $request->file->store('public/storage/c1_plano');
        }
        $upload_relawan = new Relawan;
        $upload_relawan->c1_images = $file;
        $upload_relawan->regency_id = $config->regencies_id;
        $upload_relawan->district_id = $user->districts;
        $upload_relawan->village_id = $user->villages;
        $upload_relawan->tps_id = $user->tps_id;
        $upload_relawan->status = 0;
        $upload_relawan->relawan_id = $user->id;
        $upload_relawan->save();
    }
    
}
