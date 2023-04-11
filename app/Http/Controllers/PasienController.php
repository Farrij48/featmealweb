<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Validator;
use Storage;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['pasien'] = Pasien::paginate(5);

        if($filterKeyword)
        {
            $data['pasien'] = Pasien::where('name','LIKE',"%$filterKeyword%")->paginate(5);
        }
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
        $data['pasien'] = Pasien::findOrFail($id);
        return view('pasien.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataPasien = Pasien::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'gender'=>'required',
            'status'=>'required',
            'phone' => 'required|digits_between:10,12',
            'nik'=>'required',
            'address'=>'required',
            'gejala'=>'required',
            'diagnosis'=>'required',
            'avatar'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                Storage::disk('upload')->delete($dataPasien->avatar);
                $avatarFile = $request->file('avatar');
                $extension = $avatarFile->getClientOriginalExtension();
                $fileName = "student-avatar/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/pasien-avatar";
                $request->file('avatar')->move($uploadPath,$fileName);
                $input['avatar'] = $fileName;
            }
        }

        $dataPasien->update($input);
        return redirect()->route('pasien.index')->with('status','Pasien Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataPasien = Pasien::findOrFail($id);
        $dataPasien->delete();
        Storage::disk('upload')->delete($dataPasien->avatar);
        return redirect()->back()->with('status','Pasien Berhasil Dihapus');
    }

    public function resetPassword($id)
    {
        $dataPasien = Pasien::findOrFail($id);
        $dataPasien->update(['password'=>password_hash($dataPasien->email,PASSWORD_BCRYPT)]);
        return redirect()->back()->with('status','Password Pasien Berhasil Di Reset');
    }
}