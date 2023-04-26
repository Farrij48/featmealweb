<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Category;
use App\Models\Module;
use App\Models\User;
use Validator;
use Storage;
use Illuminate\Support\Facades\Gate;

class ResepController extends Controller
{
   

    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['resep'] = Resep::paginate(5);
        if($filterKeyword)
        {
            $data['resep'] = Resep::where('title','LIKE',"%$filterKeyword%")->paginate(5);
        }
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
        $data['resep'] = Resep::findOrFail($id);
        $data['module'] = Module::where('resep_id',$id)->orderBy('order','asc')->get();
        return view('resep.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['resep'] = Resep::findOrFail($id);
        $data['category'] = Category::all();
        $data['users'] = User::where('level','chef')->get();
        return view('resep.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataResep = Resep::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'title'=>'required|max:255',
            'description'=>'required',
            'group'=>'required|max:255',
            'kalori'=>'required|max:255',
            'thumbnail'=>'sometimes|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        $input = $request->all();
        if($request->hasFile('thumbnail'))
        {
            if($request->file('thumbnail')->isValid())
            {
                Storage::disk('upload')->delete($dataResep->thumbnail);
                $thumbnailFile = $request->file('thumbnail');
                $extension = $thumbnailFile->getClientOriginalExtension();
                $fileName = "resep-thumbnail/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/resep-thumbnail";
                $request->file('thumbnail')->move($uploadPath,$fileName);
                $input['thumbnail'] = $fileName;
            }
        }
        $dataResep->update($input);
        return redirect()->route('resep.index')->with('status','Resep Berhasil Di Edit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataResep = Resep::findOrFail($id);
        $dataResep->delete();
        return redirect()->back()->with('status','Resep Berhasil Dipindah Ke Trash');
    }

    public function trash()
    {
        $data['resep'] = Resep::onlyTrashed()->paginate(5);
        return view('resep.trash',$data);
    }

    public function restore($id)
    {
        $resep = Resep::withTrashed()->findOrFail($id);
        if($resep->trashed())
        {
            $resep->restore();
        }

        else
        {
            return redirect()->route('resep.index')->with('status','Data Resep Tidak Ada Di Trashed');

        }
        return redirect()->route('resep.index')->with('status','Data Berhasil Di Restore');
    }

    public function deletePermanent($id)
    {
        $resep = Resep::withTrashed()->findOrFail($id);
        if(!$resep->trashed())
        {
            return redirect()->route('resep.index')->with('status','Tidah Bisa Menghapus Resep Secara Permanent');
        }
        else
        {
            $resep->delete();
            Storage::disk('upload')->delete($resep->thumbnail);
            return redirect()->route('resep.index')->with('status','Resep Berhasil Dihapus');
        }
    }

    public function download($id)
    {
        $module = Module::findOrFail($id);
        $filePath = env('UPLOAD_PATH').'/'.$module->document;
        return response()->download($filePath);
        
    }
}