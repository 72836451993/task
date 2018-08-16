<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{

    public function activateComplete(Request $request) {

        $data = $request->only(['email', 'token']);

        $user = (new User())
            ->where('email', '=', $data['email'])
            ->first();
        if ( $user ) {

            $token = sha1( $user->email . $user->id . $user->password );
            $user->active = 1;
            $user->save();

            return [ 'message' => 'success' ];
        } else {
            // render invalid user or token
            return [ 'message' => 'failed' ];
        }

    }

    public function activateMe(Request $request) {

        $user = Auth::user();

        $token = sha1( $user->email . $user->id . $user->password );

        // email token

        return [ 'message' => 'mail sent', 'token' => $token ];
    }

    public function registration(Request $request){
        $data = $request->all();
        $this->validate($request,[
            'username' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|confirmed',
        ]);
       $user = (new User());
       $user->insert([
           'name' => $data['username'],
           'email' => $data['email'],
           'password' => Hash::make($data['password']),
           'active' => 0
       ]);
       $accept= 'Registration successful';
       return redirect()->back()->with('massage',$accept);
    }
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        $auth = Auth::attempt($credentials);

        if ($auth){
            return redirect('/dashboard')->with('massage', 'login success');
        }
        else{
            return redirect()->back()->with('massage', 'username or password is incorrect');
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
