<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MesinCRDController extends Controller
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
    
    public function index($id)
    {
        return view('admin.mesincrud',['id'=>$id]);
    } 
}
