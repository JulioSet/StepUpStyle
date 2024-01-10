<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function createAdmin(Request $req)
    {
        $user = new user();
        $user->user_name = $req->input('fullname');
        $user->user_email = $req->input('username');
        $user->user_password = $req->input('password');
        $user->user_role="admin";
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
