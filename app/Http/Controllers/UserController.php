<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    //----------- PENGECEKAN USER UNTUK AKSES MENU -----------//
    public function __construct()
    {
        $this->middleware(function($request,$next)
        {
            if(Gate::allows('manage-users')) return $next($request);
            abort(403);
        });
    }

    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $filterLevel = $request->get('level');
        $data['users'] = User::paginate(5);
        $user = User::findOrFail(Auth::id());
        if($filterKeyword)
        {
            $data['users'] = User::where('name','LIKE',"%$filterKeyword%")
            ->where('level',$filterLevel)->paginate(5);
        }
        return view('users.index',$data,compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::findOrFail(Auth::id());
        return view('users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //------ FUNGSI VALIDATOR EMAIL --------------------//
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'name' => 'required|max:255',
            'level' => 'required',
            'gender' => 'required',
            'phone' => 'required|digits_between:10,12',
            'address' => 'required|max:255',
            'nik' => 'required|max:20',
            'avatar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if($validator-> fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if($request->file('avatar')->isValid())
        {
            $avatarFile = $request->file('avatar');
            $extension = $avatarFile->getClientOriginalExtension();
            $fileName = "user-avatar/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/user-avatar";
            $request->file('avatar')->move($uploadPath,$fileName);
            $input['avatar'] = $fileName;
        }

        $input['password'] = \Hash::make($request->get('password'));
        User::create($input);
        return redirect()->route('users.index')->with('status','User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //----------- EDIT USER DATA --------------------//
        $data['users'] = User::findOrFail($id);
        return view('users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUser = User::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'level' => 'required',
            'gender' => 'required',
            'phone' => 'required|digits_between:10,12',
            'address' => 'required|max:255',
            'avatar' => 'sometimes|nullable|image|mimes:jpeg,jpg,png'
        ]);

        if($validator-> fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                Storage::disk('upload')->delete($dataUser->avatar);
                $avatarFile = $request->file('avatar');
                $extension = $avatarFile->getClientOriginalExtension();
                $fileName = "user-avatar/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/user-avatar";
                $request->file('avatar')->move($uploadPath,$fileName);
                $input['avatar'] = $fileName;
            }
        }

        if($request->input('password'))
        {
            $input['password'] = \Hash::make($input['password']);
        }

        else
        {
            $input = Arr::except($input,['password']);
        }

        $dataUser->update($input);
        return redirect()->route('users.index')->with('status','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataUser = User::findOrFail($id);
        $dataUser->delete();
        Storage::disk('upload')->delete($dataUser->avatar);
        return redirect()->back()->with('status','User Berhasil Dihapus');
    }
}