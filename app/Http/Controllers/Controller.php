<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Events\NotifEvent;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $pesan;

    public function request()
    {

          $pesan = "".Auth::user()->name." Memverifikasi Tps ";
          $history = History::create([
              'user_id' => Auth::user()->id,
              'action' => $pesan,
          ]);
          event(new NotifEvent($pesan));
    }

    public function ambil()
    {
       return view('ambil');
    }


}
