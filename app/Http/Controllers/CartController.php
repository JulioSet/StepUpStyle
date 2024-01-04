<?php

namespace App\Http\Controllers;

use App\Models\retur;
use App\Models\sepatu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addToCart($id){ //non retur
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true);

        if ($cartSepatu === null) {
            $cartSepatu = [];
            Cookie::queue('cartSepatu', json_encode($cartSepatu), 1209600);
        }

        foreach ($cartSepatu as $c){
            if ($c['id'] == $id){
                return $this->addQty($id);
            }
        }

        $selected = sepatu::find($id);
        $sepatu = [
            "id" => $selected->sepatu_id,
            // "pict" => $selected->sepatu_pict,
            // "nama" => $selected->sepatu_name,
            // "size" => $selected->ukuran->ukuran_sepatu_nama,
            // "price" => $selected->sepatu_price,
            "qty" => 1
        ];

        array_push($cartSepatu, $sepatu);
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

        for ($i=0 ; $i < count($cartSepatu) ; $i++) {
            if ($cartSepatu[$i]['id'] == $id && $cartSepatu[$i]['qty'] > 0) {
                $cartSepatu[$i]['qty'] -= 1;
                if ($cartSepatu[$i]['qty'] == 0){
                    array_splice($cartSepatu, $i, 1);
                    Cookie::queue('cartSepatu', json_encode($cartSepatu));
                    return redirect('/cart');
                }
            }
            array_push($updatedCart, $cartSepatu[$i]);
        }

        Cookie::queue('cartSepatu', json_encode($updatedCart));
        return redirect('/cart');
    }
}
