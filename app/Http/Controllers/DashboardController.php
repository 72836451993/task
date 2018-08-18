<?php

namespace App\Http\Controllers;

use App\Images;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user = Auth::user();
            $_user = (new User())
                ->where('id','=',$user->id)
                ->first();

            return view('dashboard',['activation_check'=>$user->active,'user_images'=>$_user['images']]);
        }
        else return redirect()->back();
    }
    public function account_list(){
        $user = Auth::user();
        $users = (new User())
            ->where('id','<>',$user->id)
            ->paginate(1);

        return view('account_list',['users'=>$users]);
    }

    public function upload_img(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $_image = (new Images());
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $destinationPathForDb = '/images/';
            $image->move($destinationPath, $name);
            $_image->insert([
                'user_id' => $user->id,
                'image_path' => $destinationPathForDb.$name
            ]);

            return back()->with('success','Image Upload successfully');
        }

    }
}
