<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

            $hashPassword = Hash::make($password);
            $hashVerification = Hash::make($email);

            DB::table('user')->insert([
                'user_name' => $name,
                'user_email' => $email,
                'user_password' => $hashPassword,
                'user_profile' => 'basic_profile_picture.jpg',
                'verification' => $hashVerification
            ]);

            $subject = "Email Confirmation";
            $id = user::where('user_email', $email)->first()->user_id;

            Mail::to($email)->send(new SendMail($name, $subject, $id, $hashVerification));

            return redirect('/login')->with('msg', 'Verify your email!');
        }
        else{
            return redirect()->back()->with('msg', 'Email exist!');
        }
    }

    public function verifyEmail($id, $hash)
    {
        $user = user::find($id);
        if ($user->verification == $hash) {
            $user->user_verification = 1;
            $user->save();
        }
        return redirect('/login')->with('msg', 'Registration completed!');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $cekUser = DB::table('user')->where("user_email", "=", $email)->first();

        if ($cekUser != null) {
            $listUser = user::all();
            
            foreach($listUser as $key) {
                if ($key->user_email == $email) {
                    if(Hash::check($password, $key->user_password) == true) {

                        if ($key->user_role == "admin") {
                            
                            $AdminLoggedIn = [
                                "id" => $key->user_id,
                                "name" => $key->user_name,
                                "email" => $key->user_email,
                                "password" => $key->user_password,
                                "profile" => $key->user_profile,
                                "role" => $key->user_role
                            ];
                            Session::put('adminLoggedIn', $AdminLoggedIn);
                            return redirect("admin");
                        }
                        else if($key->user_role == "owner"){
                            Session::put('ownerLoggedIn', "Owner");
    
                            return redirect("owner");
                        }
                        else if($key->user_role == "customer"){
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
                    else {
                        return redirect()->back()->with('msg', 'Password is Incorrect!');
                    }
                }
            }
        }
        else{
            return redirect()->back()->with('msg', 'Email is not registered!');
        }
    }

    public function logout(Request $request)
    {
        Session::forget('userLoggedIn');
        Session::forget('adminLoggedIn');
        Session::forget('ownerLoggedIn');
        if (Session::has('remember_me')) {
            Session::forget('remember_me');
        }
        return redirect()->route('home');
    }

    public function editProfile(Request $request)
    {
        $listUser = user::all();

        $userLog = Session::get('userLoggedIn');

        $id = $userLog['id'];

        $cekPassword = $request->old_password;

        if ($cekPassword != '') {

            if(Hash::check($cekPassword, $userLog['password']) == true) {
                $usernameChange = $request->name;
                $emailChange = $request->email;
                $passwordChange = $request->password;
                $profileChange = $request->profile_picture;

                if ($emailChange == $userLog['email']) {
                    if ($profileChange != '') {
                        $rules = [
                            'name' => ["required", "min:1"],
                            'email' => 'required',
                            'password' => 'confirmed',
                            'old_password' => 'required',
                            'profile_picture' => 'required',
                            'profile_picture.*' => "mimes:gif,jpg,jpeg,png"
                        ];
                    }
                    else {
                        $rules = [
                            'name' => ["required", "min:1"],
                            'email' => 'required',
                            'password' => 'confirmed',
                            'old_password' => 'required',
                        ];
                    }
                }
                else {
                    $cekUser = DB::table('user')->where("user_email", "=", $emailChange)->first();

                    if ($cekUser == null) {
                        if ($profileChange != '') {
                            $rules = [
                                'name' => ["required", "min:1"],
                                'email' => 'required',
                                'password' => 'confirmed',
                                'old_password' => 'required',
                                'profile_picture' => 'required',
                                'profile_picture.*' => "mimes:gif,jpg,jpeg,png"
                            ];
                        }
                        else {
                            $rules = [
                                'name' => ["required", "min:1"],
                                'email' => 'required',
                                'password' => 'confirmed',
                                'old_password' => 'required',
                            ];
                        }
                    }
                    else{
                        return redirect()->back()->with('msg', 'Email already registered!');
                    }
                }

                $messages = [
                    "required" => "Please fill this field",
                    "confirmed" => "Confirm Password does not match",
                    "mimes" => "Photo must be either in gif, png, jpg or jpeg!"
                ];
                $request->validate($rules, $messages);

                if ($passwordChange == '') {
                    if ($profileChange == '') {
                        $user = [
                            "id" => $userLog['id'],
                            "name" => $request->name,
                            "email" => $request->email,
                            "password" => $userLog['password'],
                            "profile" => $userLog['profile'],
                            "role" => $userLog['role']
                        ];
                    }else {
                        $namaFolderPhoto = ""; $namaFilePhoto = "";
                        foreach ($request->file("profile_picture") as $photo) {
                            $namaFilePhoto  = 'profileuser'.$id.".".$photo->getClientOriginalExtension();
                            $namaFolderPhoto = "photo/";

                            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
                        }

                        $user = [
                            "id" => $userLog['id'],
                            "name" => $request->name,
                            "email" => $request->email,
                            "password" => $userLog['password'],
                            "profile" => $namaFilePhoto,
                            "role" => $userLog['role']
                        ];
                    }
                }else {
                    if ($profileChange == '') {
                        $user = [
                            "id" => $userLog['id'],
                            "name" => $request->name,
                            "email" => $request->email,
                            "password" => Hash::make($request->password),
                            "profile" => $userLog['profile'],
                            "role" => $userLog['role']
                        ];
                    }else {
                        $namaFolderPhoto = ""; $namaFilePhoto = "";
                        foreach ($request->file("profile_picture") as $photo) {
                            $namaFilePhoto  = 'profileuser'.$id.".".$photo->getClientOriginalExtension();
                            $namaFolderPhoto = "photo/";

                            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
                        }

                        $user = [
                            "id" => $userLog['id'],
                            "name" => $request->name,
                            "email" => $request->email,
                            "password" => Hash::make($request->password),
                            "profile" => $namaFilePhoto,
                            "role" => $userLog['role']
                        ];
                    }
                }

                DB::table('user')->where('user_id', '=', $id)->update([
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'user_password' => $user['password'],
                    'user_profile' => $user['profile']
                ]);


                Session::put('userLoggedIn', $user);

                return redirect()->route('user-edit')->with('msgSuccess', 'Edit succeed!');
            }
        }else {
            return redirect()->back()->with('msg', 'Input your password to save changes!');
        }
    }
}
