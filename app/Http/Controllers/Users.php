<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class Users extends Controller
{
    public function profile()
    {
        return view('profile.show');
    }

    public function edit_profile()
    {
        return view('profile.edit_profile');
    }
}
