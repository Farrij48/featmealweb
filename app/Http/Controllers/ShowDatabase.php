<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShowDatabase extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('home', compact('user'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name'       => 'required|string|min:2|max:100',
            'email'      => 'required|email|unique:users,email, ' . $id . ',id',
            
            'old_password' => 'nullable|string',
            'password' => 'nullable|required_with:old_password|string|confirmed|min:6',

        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->nik = $request->nik;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Please enter the correct password')])
                    ->withInput();
            }
        }

        if (request()->hasFile('avatar')) {
            if($user->avatar && file_exists(public_path('avatar' . $user->avatar))){
                Storage::delete('app/public/avatar/'.$user->avatar);
            }

            $file = $request->file('avatar');
            $fileName = $file->hashName() . '.' . $file->getClientOriginalExtension();
            $request->avatar->move(public_path('avatar'), $fileName);
            $user->avatar = $fileName;
        }
        

        $user->save();

        return back()->with('status', 'Profile updated!');
    }
}
