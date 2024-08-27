<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if(!$user)
        {
            return redirect()->back()->with('error','Account Not Found');
        }
        if(!Hash::check($request->password,$user->password)){
            return redirect()->back()->with('error','Incorrect Password');
        }
        auth()->login($user);
        return redirect('/')->with('success','Welcome '.$user->name);
    }

    public function showRegister()
    {
        return view('auth.register');
    }
    public function postRegister(Request $request)
    {
        request()->validate([
            'name'=>"required",
            'email'=>"required|email",
            'password'=>"required",
            'image'=>"required|mimes:png,jpg,jpeg,webp",
            'phone'=>"required",
            'address'=>"required",
        ]);

        //check existing email//
        $findUser=User::where('email',request()->email)->first();
        if($findUser){
            return redirect()->back()->with('error','Already Registered');
        }
        $file=request()->file('image');
        $file_name=uniqid().$file->getClientOriginalName();
        $file->move(public_path('/images'),$file_name);
        $user=User::create([
            'image'=>$file_name,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'password'=>Hash::make($request->email),
        ]);
        auth()->login($user);
        return redirect('/')->with('success','Welcome '.$user->name);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

}
