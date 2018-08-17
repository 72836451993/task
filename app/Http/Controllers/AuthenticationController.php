<?php

namespace App\Http\Controllers;

use App\Mail\ActivationMail;
use App\Mail\RecoverMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{

    public function recovery(){
        return view('recover_account');
    }
    public function recover_account(Request $request){
        $data=$request->only('email');
        $user = (new User())
        ->where('email','=',$data['email'])
        ->first();

        if($user){
            $token = sha1( $user->email . $user->id . $user->password );
            Mail::to($user->email)->send(new RecoverMail(['email'=>$user->email,'token'=>$token]));
            return redirect('/')->with(['recoverMSG'=>'Recover email send']);
        }
        else{
            return redirect()->back()->with(['recoverERROR'=>'you enter wrong email']);
        }
    }
    public function recover_process(Request $request){

        $data = $request->only('email','token');

        return view('recover_account_page',['data'=>$data]);
    }
    public function recover_complete(Request $request){
        $data = $request->only('email','token','password','password_confirmation');
        $this->validate($request,[
            'password' => 'required|confirmed',
        ]);
        $user = (new User())
            ->where('email','=',$data['email'])
            ->first();
        if($user){
            $token = sha1( $user->email . $user->id . $user->password );
            if($token === $data['token']){
                $user->password = Hash::make($data['password']);
                $user->save();
                return redirect('/')->with(['recoverCompeteMSG'=>'Recover complete, Now you can login']);
            }
            else{
                return redirect('/')->with(['recoverCompeteERROR'=>'Something went wrong, Try again']);
            }
        }
    }
    public function activateComplete(Request $request) {

        $data = $request->only(['email', 'token']);
        $user = (new User())
            ->where('email', '=', $data['email'])
            ->first();
        if ( $user ) {
            $token = sha1( $user->email . $user->id . $user->password );

            if($data['token']===$token){

                $user->active = 1;
                $user->save();

                if(Auth::check()){
                    return redirect('/dashboard')->with(['successMSG' => 'activation complete']);
                }
                else{
                    return redirect('/')->with(['successMSG' => 'activation complete']);
                }

            }
        } else {
            // render invalid user or token
            return [ 'message' => 'failed' ];
        }

    }

    public function activateMe(Request $request) {

        $user = Auth::user();


        $token = sha1( $user->email . $user->id . $user->password );

        // email token
        Mail::to($user->email)->send(new ActivationMail(['email'=>$user->email,'token'=>$token]));

        return redirect()-> back()->with([ 'massage' => 'Activation email send']);
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
            return redirect('/dashboard');
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
