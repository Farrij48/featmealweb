<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Validator ;
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

    // ---------------------------- FUNGSI INSERT DATA CATEGORY ----------------------------------//
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

   
    //-------------------- FUNGSI UPDATE DATA CATEGORY ----------------------------------------//

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

    
    //---------------------- FUNGSI TRASH DATA CATEGORY -----------------------------------------------//
    public function destroy(string $id)
    {
        $dataCategory = Category::findOrFail($id);
        $dataCategory->delete();
        return redirect()->back()->with('status','Category Berhasil Dibuang');
    }

    public function trash()
    {
        $data['category'] = Category::onlyTrashed()->paginate(5);
        return view('category.trash',$data);
    }


    //------------------------- FUNGSI RESTORE DATA CATEGORY ---------------------------------------------//
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if($category->trashed())
        {
            $category->restore();
        }

        else
        {
            return redirect()->route('category.index')->with('status','Category Tidak Ditemukan');
        }

        return redirect()->route('category.index')->with('status','Category Berhasil Di Restore');
    }

    //------------------ FUNGSI DELETE PERMANEN DATA CATEGORY --------------------------------------------//
    public function deletePermanent($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if(!$category->trashed())
        {
            return redirect()->route('category.index')->with('status','Tidak Bisa Delete Permanent');
        }
        else
        {
            $category->forceDelete();
            Storage::disk('upload')->delete($category->thumbnail);
            return redirect()->route('category.index')->with('status','Category Berhasil Dihapus Permanent');
        }
    }
}