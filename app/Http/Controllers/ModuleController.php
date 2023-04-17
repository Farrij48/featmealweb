<?php

namespace App\Http\Controllers;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index()
    {
        $data['resep'] = Resep::where('user_id',Auth::user()->id)->paginate(5);
        return view('module.index',$data);
    }
}