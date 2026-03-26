<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sinup;
use Illuminate\Support\Facades\Hash; 


class AuthController extends Controller
{
    function sinupdata(Request $request){
        $validation = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:sinups,email',
            'password' => 'required|min:6',
            'address' => 'required',
            'image' => 'required|image'
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => false,
                'response' => $validation->errors(), 
            ], 422);
        }

        $save = new sinup;

        $save->name = $request->input('name');
        $save->email = $request->input('email');
        $save->password = Hash::make($request->password);
        $save->address = $request->input('address');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path('asset/images'), $imageName);
            $save->image = $imageName;
        }

        $save->save();

        return response()->json([
            'status' => true,
            'response' => 'your data has been saved',
            'data' => $save
        ]);
    }


    function logindata(Request $request){
        $validation = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => false,
                'response' => $validation->errors()
            ], 422);
        }

        $user = sinup::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {

            return response()->json([
                'status' => false,
                'message' => 'invalid email or password'
            ]);
        }
        $token = $user->createToken('main')->plainTextToken;

        return response()->json([
            'status' => true,
            'response' => 'welcome to dashboard',
            'token' => $token
        ], 200);
    }
}
