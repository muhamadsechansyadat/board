<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/

	public function register(Request $request){
		$register = new User();
	    $register->username = $request->username;
	    $register->email = $request->email;
	    $register->password = app('hash')->make($request->password);
	    $register->api_token = str_random(50);

        $response['success'] = true;

        if ($register && $register->save()) {
            $response['message'] = 'Berhasil Di Simpan';
            $response['data'] = $register;
        }else{
            $response['success'] = false;
            $response['message'] = 'Gagal Tersimpan';
            $response['data'] = '';
        }
		return response()->json($response);
	}

	public function login(Request $request){
		$user = User::where('email', $request->email)->first();

		if(!$user){
			return response()->json(['status'=>'error','message'=>'User Not Found'],401);
		}

		if(Hash::check($request->password, $user->password)){
			$user->update(['api_token'=>str_random(50)]);
			return response()->json(['status'=>'success','user'=>$user],200);
		}

		return response()->json(['status'=>'error','message'=>'User Not Found'],401);
	}

	public function logout(Request $request){
		$api_token = $request->api_token;

		$user = User::where('api_token', $api_token)->first();

		if(!$user){
			return response()->json(['status'=>'error','message'=>'Not Logged In'],401);
		}

		$user->api_token=null;

		$user->save();

		return response()->json(['status'=>'Success','message'=>'You are now logged out'],200);
	}
}	