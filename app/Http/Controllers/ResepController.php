<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Category;
use App\Models\User;
use Validator;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['resep'] = Resep::paginate(5);
        return view('resep.index',$data);
    }

    public function create()
    {
        $data['category'] = Category::all();
        $data['users'] = User::where('level','chef')->get();
        return view('resep.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required|max:255',
            'description'=>'required',
            'group'=>'required|max:255',
            'kalori'=>'required|max:255',
            'thumbnail'=>'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        if($request->file('thumbnail')->isValid()){
            $thumbnailFile = $request->file('thumbnail');
            $extension = $thumbnailFile->getClientOriginalExtension();
            $fileName = 'resep-thumbnail/'.date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/resep-thumbnail";
            $request->file('thumbnail')->move($uploadPath,$fileName);
            $input['thumbnail'] = $fileName;
        }

        Resep::create($input);
        return redirect()->route('resep.index')->with('status','Resep Berhasil Ditambah');
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