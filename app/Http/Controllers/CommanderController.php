<?php

namespace App\Http\Controllers;

use App\Events\CommanderEvent;
use App\Models\Config;
use App\Models\NotificationCommander;
use App\Models\Paslon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommanderController extends Controller
{
    public function index()
    {
         date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['config'] = Config::first();
        $data['paslon'] = Paslon::with('saksi_data')->get();
        $data['notif'] = NotificationCommander::get();
        return view('administrator.commander_remote.index', $data);
    }
    public function notifDel()
    {
        NotificationCommander::where('id','!=',null)->delete();
        return redirect()->back();
    }
    public function redirect(Request $request)
    {
        $page = ($request->user_id != null) ?
            [
                'page' => $request->page, 
                'user_id' => $request->user_id
            ]
            :
            [
                'page' => $request->page, 
                'order' => $request->order
            ];
        if ($request->order != null) {
            event(new CommanderEvent($page));
            NotificationCommander::where('order', $request->order)->delete();
            return response()->json(['success' => 'success redirect Admin' . $request->order], 200);
        }

        event(new CommanderEvent($page));
    }
    public function scroll(Request $request)
    {
        $dist = ($request->user_id != null) ?
            [
                'dist' => $request->dist,
                'user_id' => $request->user_id
            ]
            :
            [
                'dist' => $request->dist,
                'order' => $request->order
            ];
        event(new CommanderEvent($dist));
    }
    public function settings(Request $request)
    {

        $set = ($request->user_id != null) ?
            [
                'set' => "hehe",
                'user_id' => $request->user_id
            ]
            :
            [
                'set' => "berhasil",
                'order' => $request->order
            ];
        if ($request->order != null) {
            event(new CommanderEvent($set));
            NotificationCommander::where('order', $request->order)->delete();
        }

        if ($request->set == "show_terverifikasi" || $request->set == "show_public") {
            $cekConfig = Config::where($request->set, 'hide')->first();
            if ($cekConfig != null) {
                DB::table('config')->update([
                    $request->set => "show"
                ]);
            } else {
                DB::table('config')->update([
                    $request->set => "hide"
                ]);
            }

            event(new CommanderEvent($set));
            return 'berhasil';
        }

        $cekConfig = Config::where($request->set, 'no')->first();
        if ($cekConfig != null) {
            DB::table('config')->update([
                $request->set => "yes"
            ]);
        } else {
            DB::table('config')->update([
                $request->set => "no"
            ]);
        }

        event(new CommanderEvent($set));
        return 'berhasil';
    }
    public function defaults(Request $request)
    {
        $cekConfig = Config::where('default', 'no')->first();
        if ($cekConfig != null) {
            DB::table('config')->update([
                'default' => "yes",
                'show_public'=>'hide',
                'show_terverifikasi'=>'hide',
                'lockdown'=>'no',
                'otonom'=>'yes',
                'multi_admin'=>'no',
                'darkmode'=>'no',
                'quick_count'=>'no',
            ]);


        } else {
            DB::table('config')->update([
                'default' => "no"
            ]);
        }
        return response()->json(['success'=>true],200);
    }
}
