<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Resep;
use App\Models\Pasien;
use App\Models\Module;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        $data['chef'] = User::where('level','chef')->count();
        $data['module'] = Module::count();
        $countp = Pasien::count();
        $countr = Resep::count();
        $filterKeyword = $request->get('keyword');
        $data['pasien'] = Pasien::paginate(5);
        $data['resep'] = Resep::where('user_id',Auth::user()->id)->paginate(5);
        $user = User::findOrFail(Auth::id());

        if($filterKeyword)
        {
            $data['pasien'] = Pasien::where('name','LIKE',"%$filterKeyword%")->paginate(5);
        }
        
        return view('home',$data,compact('user','countr','countp'));
    }
}