<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with('questions')->findOrFail($id);

        return view('main.profile',compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('main.setting',compact('user'));
    }
    public function update(Request $request)
    {
        // dd($request->text);
        // $request->except('text');
        $request->validate([
            'name' =>'required|string|min:1|max:20',
            'email' =>'required|email|unique:users,email,'.Auth::user()->id,
            'address' =>'required|string|min:1|max:20',
            'bio' =>'required|string|min:1',
            'image' =>'image|mimes:png,jpg,jpeg|max:4048'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');// get image
            $image_new_name = time() .'.'. $image->getClientOriginalExtension();//Getting Image Extension
            $image->move("storage/users/",$image_new_name);
            $data = "storage/users/" . $image_new_name;

            // anther solution
            // $data = $request->file('image')->store('users');
        }

        User::findOrFail(Auth::user()->id)->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $profile = Profile::where('user_id',Auth::user()->id)->first();

        $profile->update([
            'address'   =>$request->address,
            'bio'       =>$request->bio,
            'image'     =>isset($data)? $data : $profile->image
        ]);

        session()->flash('message','Updated Your Profile Successfully');
        return redirect()->back();

    }

    public function chnagePassword(Request $request)
    {

        $data = $request->except(['_token','_method']);

        $request->validate([
            'password'              => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password does not match!');
        }

        $data['password'] = Hash::make($request->password);
        // dd($data);

        $user->update([
            'password' => $data['password'],
        ]);

        session()->flash('message','Updated Password Successfully');
        return redirect()->back();
    }


    public function recover()
    {
        return view('main.recover-password');
    }
}
