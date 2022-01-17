<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MesinCRDController extends Controller
{
    
    public function index($id)
    {
        return view('admin.mesincrud',['id'=>$id]);
    } 
}
