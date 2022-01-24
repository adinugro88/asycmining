<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mesin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class DatahasilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $listinvestor = Auth::User()->where('is_admin',0)->get();
        return view('admin.income',['listinvestor'=>$listinvestor]);
    }

    public function crud($id)
    {
        return view('admin.incomecrud',['id'=>$id]);
    } 

    public function adminHome()
    {
        $listinvestor = Auth::User()->where('is_admin',0)->get();

        return view('adminHome',['listinvestor'=>$listinvestor]);
    }
}
