<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pasien'] = Pasien::paginate(5);
        return view('pasien.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|max:255|unique:pasien',
            'name'=>'required|max:255',
            'gender'=>'required',
            'phone' => 'required|digits_between:10,12',
            'nik'=>'required',
            'address'=>'required',
            'gejala'=>'required',
            'diagnosis'=>'required',
            'avatar'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        if($request->file('avatar')->isValid())
        {
            $avatarFile = $request->file('avatar');
            $extension = $avatarFile->getClientOriginalExtension();
            $fileName = "student-avatar/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/student-avatar";
            $request->file('avatar')->move($uploadPath,$fileName);
            $input['avatar'] = $fileName;
        }

        $input['password'] = password_hash($request->get('email'),PASSWORD_BCRYPT);
        Pasien::create($input);

        return redirect()->route('pasien.index')->with('status','Pasien Berhasil Ditambahkan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}