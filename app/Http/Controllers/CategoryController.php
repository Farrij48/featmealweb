<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['category'] = Category::paginate(5);
        return view('category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'thumbnail'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();

        }

        $input = $request->all();
        if($request->file('thumbnail')->isValid())
        {
            $thumbnailFile = $request->file('thumbnail');
            $extension = $thumbnailFile->getClientOriginalExtension();
            $fileName = "category/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/category";
            $request->file('thumbnail')->move($uploadPath,$fileName);
            $input['thumbnail'] = $fileName;
        }
        Category::create($input);
        return redirect()->route('category.index')->with('status','Category Berhasil Ditambah');
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
        $data['category'] = Category::findOrFail($id);
        return view('category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataCategory = Category::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'thumbnail'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);

        }

        $input = $request->all();
        if($request->hasFile('thumbnail')){
            if($request->file('thumbnail')->isValid()){
                Storage::disk('upload')->delete($dataCategory->thumbnail);
                $thumbnailFile = $request->file('thumbnail');
                $extension = $thumbnailFile->getClientOriginalExtension();
                $fileName = "category/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/category";
                $request->file('thumbnail')->move($uploadPath,$fileName);
                $input['thumbnail'] = $fileName;
            }
        }

        $dataCategory->update($input);
        return redirect()->route('category.index')->with('status','Category berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataCategory = Category::findOrFail($id);
        $dataCategory->delete();
        return redirect()->back()->with('status','Category Berhasil Dibuang');
    }
}