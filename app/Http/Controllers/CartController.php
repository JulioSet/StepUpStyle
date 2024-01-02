<?php

namespace App\Http\Controllers;

use App\Models\retur;
use App\Models\sepatu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addToCart($id){
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true) ?? [];

        foreach ($cartSepatu as $c){
            if ($c->id == $id){
                $c->qty += 1;
            }
            Cookie::queue('cartSepatu', json_encode($cartSepatu));
            return redirect('/cart');
        }

        $selected = sepatu::find($id);

        $sepatu = [
            "id" => $selected->sepatu_id,
            "pict" => $selected->sepatu_pict,
            "nama" => $selected->sepatu_name,
            "size" => $selected->ukuran->ukuran_sepatu_nama,
            "price" => $selected->sepatu_price,
            "qty" => 1
        ];

        //PUSH Sepatu
        array_push($cartSepatu, $sepatu);

        //REPLACE COOKIE
        Cookie::queue('cartSepatu', json_encode($cartSepatu));
        return redirect('/cart');
    }

    public function addQty($id){
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true);
        $updatedCart = [];

        foreach ($cartSepatu as $c){
            if ($c['id'] == $id){
                $c['qty'] += 1;
            }
            array_push($updatedCart, $c);
        }
        Cookie::queue('cartSepatu', json_encode($updatedCart));
        return redirect('/cart');
    }

    public function substractQty($id){
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true);
        $updatedCart = [];

        foreach ($cartSepatu as $c){
            if ($c['id'] == $id && $c['qty'] > 1){
                $c['qty'] -= 1;
                array_push($updatedCart, $c);
            }
            if ($c['qty'] == 0){
                unset($c);
            }
        }
        Cookie::queue('cartSepatu', json_encode($updatedCart));
        return redirect('/cart');
    }
}
