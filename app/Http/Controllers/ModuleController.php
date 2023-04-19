<?php

namespace App\Http\Controllers;
use App\Models\Resep;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Storage;

class ModuleController extends Controller
{
    public function index()
    {
        $data['resep'] = Resep::where('user_id',Auth::user()->id)->paginate(5);
        return view('module.index',$data);
    }

    public function detail($id)
    {
        $data['resep_id'] = $id;
        $data['resep'] = Resep::findOrFail($id);
        $data['module'] = Module::where('resep_id',$id)->orderBy('order','asc')->paginate(5);
        return view('module.detail',$data);
    }

    public function create($id)
    {
        $data['resep_id'] = $id;
        $data['resep'] = Resep::findOrFail($id);
        return view('module.create',$data);
    }

    public function store(Request $request)
    {
        //---------- ATURAN FORM VALIDASI UPLOAD MODULE -----------------//
        $standartRule = [
            'title' =>'required|max:50',
            'description' =>'required|max:250',
            'module_type' =>'required',
        ];
        if($request->get('module_type')=="file")
        {
            $standartRule['document'] = "required|mimes:mp4,pdf|max:62000";
        }
        if($request->get('module_type')=="youtube")
        {
            $standartRule['youtube'] = "required|max:255";
        }

        $validator = Validator::make($request->all(),$standartRule);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if($request->get('module_type')=="file")
        {
            if($request->file('document')->isValid())
            {
                $documentFile = $request->file('document');
                $extension = $documentFile->getClientOriginalExtension();
                $slug = \Str::slug($request->get('title'));
                $filename = "document-module/".date('YmdHis').".".$slug.".".$extension;
                $uplaodPath = env('UPLOAD_PATH')."/document-module";
                $request->file('documen')->move($uplaodPath,$filename);
                $input['file_type'] = $documentFile->getClientOriginalExtension();
                $input['document'] = $filename;
            }
        }
        Module::create($input);
        $resep_id = $request->get('resep_id');
        return redirect()->route('module.detail',[$resep_id])->with('status','Module Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data['module'] = Module::findOrFail($id);
        return view('module.edit',$data);
    }

    public function update(Request $request,$id)
    {
        $dataModule = Module::findOrFail($id);
        $standartRule = [
            'title' =>'required|max:50',
            'description' =>'required|max:250',
            'module_type' =>'required',
        ];
        if($request->get('module_type')=="file")
        {
            $standartRule['document'] = "sometimes|nullable|mimes:mp4,pdf|max:62000";
        }
        if($request->get('module_type')=="youtube")
        {
            $standartRule['youtube'] = "required|max:255";
        }

        $validator = Validator::make($request->all(),$standartRule);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        //------------- PENGECEKAN MODULE TYPE FILE PADA HALAMAN UPDATE DATA MODULE -----------//
        $input = $request->all();
        if($request->get("module_type") == "file")
        {
            if($request->hasFile("document"))
            {
                if($request->file("document")->isValid())
                {
                    $documentFile = $request->file('document');
                    $extension = $documentFile->getClientOriginalExtension();
                    $slug = \Str::slug($request->get('title'));
                    $filename = "document-module/".date('YmdHis').".".$slug.".".$extension;
                    $uplaodPath = env('UPLOAD_PATH')."/document-module";
                    $request->file('document')->move($uplaodPath,$filename);
                    $input['file_type'] = $documentFile->getClientOriginalExtension();
                    $input['document'] = $filename;

                    if($dataModule->module_type == "file")
                    {
                        Storage::disk('upload')->delete($dataModule->document);
                    }
                }
            }
        }

        if($request->get('module_type')== "youtube")
        {
            $input['document'] = "";
            $input['file_type'] = "";
        }

        if($request->get('module_type') == "file")
        {
            $input['youtube'] = "";
        }

        $dataModule->update($input);
        $resep_id = $request->get('resep_id');
        return redirect()->route('module.detail',[$resep_id])->with('status','Module Berhasil Di Edit');
    }
}