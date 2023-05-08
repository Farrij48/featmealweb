<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use Validator;
use App\Http\Resources\PasienResource;

class PasienController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'email'=>'required',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>FALSE,
                'msg'=>$validator->errors()
            ],400);
        }
        $email = $request->input('email');
        $password = $request->input('password');

        $pasien = Pasien::where([
            ['email',$email],
            ['status','active'],
        ])->first();

        if(is_null($pasien))
        {
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Email & Password tidak sesuai'
            ],200);
        }
        else
        {
            if(password_verify($password,$pasien->password))
            {
                //--------- JIKA PASSWORD SESUAI -------------//
                return response()->json([
                    'status'=>TRUE,
                    'msg'=>'User Ditemukan',
                    'data'=>new PasienResource($pasien)
                ],200);
            }

            else
            {
                 //--------- JIKA TIDAK PASSWORD SESUAI -------------//
                return response()->json([
                    'status'=>FALSE,
                    'msg'=>'Email & Password Tidak Sesuai',

                ],200);
            }
        }
    }
}