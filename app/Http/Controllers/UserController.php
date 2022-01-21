<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function registration(Request $request){
        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required'

        ]);
        if($validation->fails()){
            return response()->json($validation->errors(),202);

        }
        $allData =$request->all();
        $allData['password']=bcrypt($allData['password']);
        $user =User::create($allData);  
        // $resArr ['token']=$user->createToken('api-application')->accsessToken;
        $resArr['name']=$user->name;
        return response()->json($resArr,200);
    }
    public function loginForm(){
        return view('loginForm');
    }
    public function login(Request $request){
        if(Auth::attempt([
            'email' =>$request->email, 
            'password' => $request->password])){
                $user = Auth::user();
                // $resArr ['token']=$user->createToken('api-application')->accsessToken;
                $resArr['name']=$user->name;
                return response()->json($resArr,200);
        }else{
            return response()->json(['erro'=>'Unauthorrized Acsess'],203);
        }
    }
}
