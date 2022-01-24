<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MesinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function adminHome()
    {
        $listinvestor = Auth::User()->where('is_admin',0)->get();

        return view('adminHome',['listinvestor'=>$listinvestor]);
    }
    
    public function index()
    {
        $listinvestor = Auth::User()->where('is_admin',0)->get();
       return view('admin.mesin',['listinvestor'=>$listinvestor]);
    }
}
