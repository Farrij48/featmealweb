<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Module;
use App\Http\Resources\ResepResource;
use App\Http\Resources\ModuleResource;

class ResepController extends Controller
{
    function getByCategory(Request $request)
    {
        $id = $request->input('category_id');
        $resep = Resep::where([
            ['category_id',$id]
        ])->get();

        if($resep->isEmpty())
        {
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Resep Tidak Ditemukan'
            ],200);
        }
        return ResepResource::collection($resep);
    }

    function getById(Request $request)
    {
        $id = $request->input('id');
        $resep = Resep::find($id);
        if(is_null($resep))
        {
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Resep Tidak Ditemukan'
            ],404);
        }

        $module = Module::where([
            ['resep_id',$id],
            ['status','active'],
        ])->get();
        return response()->json([
            'status'=>TRUE,
            'data'=>[
                "resep"=> new ResepResource($resep),
                "detail"=> ModuleResource::collection($module)
            ]
            ]);
    }
}