<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MesinController extends Controller
{
    public function index()
    {
        $listinvestor = Auth::User()->where('is_admin',0)->get();
       return view('admin.mesin',['listinvestor'=>$listinvestor]);
    }
}
