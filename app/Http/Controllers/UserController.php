<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request) 
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $name = $request->input('name');

        $cekUser = DB::table('user')->where("user_email", "=", $email)->first();

        if ($cekUser == null) {   
            $rules = [
                'name' => ["required", "min:1"],
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'email' => 'required'
            ];
            $messages = [
                "required" => "Please fill this field",
                "confirmed" => "Confirm Password does not match",
            ];
            $request->validate($rules, $messages);

            DB::table('user')->insert([
                'user_name' => $name,
                'user_email' => $email,
                'user_password' => $password
            ]);
    
            return redirect('/login')->with('msg', 'Registration succeed!');
        }
        else{
            return redirect()->back()->with('msg', 'Email exist!');
        }
    }

    public function login(Request $request) 
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $cekUser = DB::table('user')->where("user_email", "=", $email)->where("user_password", "=", $password)->first();

        if ($cekUser != null) {
            $listUser = user::all();

            foreach($listUser as $key) {
                if ($key->user_email == $email) {
                    
                    $userLoggedIn = [
                        "id" => $key->user_id,
                        "name" => $key->user_name,
                        "email" => $key->user_email,
                        "password" => $key->user_password,
                        "profile" => $key->user_profile,
                        "role" => $key->user_role
                    ];

                    Session::put('userLoggedIn', $userLoggedIn);
                    
                    return redirect()->route('home');          
                }
            }
        }
        else{
            return redirect()->back()->with('msg', 'Email or Password is Incorrect!');
        }  
    }

    public function logout(Request $request) 
    {
        Session::forget('userLoggedIn');
        if (Session::has('remember_me')) {    
            Session::forget('remember_me');
        }
        return redirect()->route('home');
    }
}
