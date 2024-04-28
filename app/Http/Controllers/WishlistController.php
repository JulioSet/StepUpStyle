<?php

namespace App\Http\Controllers;

use App\Models\wishlist;
use App\Http\Requests\StorewishlistRequest;
use App\Http\Requests\UpdatewishlistRequest;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function like(Request $request)
    {
        $user = Session::get('userLoggedIn');
        $sepatu_id = $request->input('sepatu_id');

        $wishlist = wishlist::create([
            'fk_sepatu' => $sepatu_id,
            'fk_customer' => $user['id'],
        ]);
        $wishlist->save();

        return redirect($request->input('url'))->with('success', 'Added to Wishlist!');
    }
    
    public function unlike(Request $request)
    {
        $user = Session::get('userLoggedIn');
        $sepatu_id = $request->input('sepatu_id');

        wishlist::where('fk_sepatu', '=', $sepatu_id)
        ->where('fk_customer', '=', $user['id'])
        ->delete();

        return redirect($request->input('url'))->with('success', 'Removed from Wishlist!');
    }
}
