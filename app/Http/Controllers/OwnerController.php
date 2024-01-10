<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function createAdmin(Request $req)
    {
        $user = new user();
        $user->user_name = $req->input('fullname');
        $user->user_email = $req->input('username');
        $user->user_password = Hash::make($req->input('password'));
        $user->user_role="admin";
        $user->user_verification = 1;
        $user->verification = "admin";
        $user->save();

        return redirect("/owner");
    }

    public function deleteAdmin($id)
    {
        $user = user::find($id);
        $user->delete();

        return redirect("/owner");
    }
}
