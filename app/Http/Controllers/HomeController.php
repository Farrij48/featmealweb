<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Resep;
use App\Models\Module;
use App\Models\Pasien;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['chef'] = User::where('level','chef')->count();
        $data['resep'] = Resep::count();
        $data['module'] = Module::count();
        $data['pasien'] = Pasien::count();
        return view('home',$data);
    }
}