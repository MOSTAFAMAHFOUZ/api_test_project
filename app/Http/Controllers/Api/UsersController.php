<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function register(UserRequest $request){
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'api_token'=>Str::random(60).time()
        ]);
        
        return response(['data'=>$user,'message'=>"You have been registerd"],200);
    }

    public function login(Request $request){

        $request->validate([
            'email'=>'required|email|max:40',
            'password'=>'required|string|max:30',
        ]);
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $token = Str::random(60).time();
            $user = User::where('email',$request->email)->first();
            $user->api_token = $token;
            $user->save();
            return response()->json(['data'=>$user,'message'=>''],200);
        }else{
            return response()->json(['data'=>'','message'=>'Data Not Correct'],422);
        }
    }


    public function logout(Request $request){

        $user = User::where('api_token',$request->api_token)->first();
        $user->api_token = null;
        $user->save();
        return response()->json(['data'=>'','message'=>''],200);
    }
}
