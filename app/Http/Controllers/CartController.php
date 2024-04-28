<?php

namespace App\Http\Controllers;

use App\Models\DetailSepatu;
use App\Models\retur;
use App\Models\sepatu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart($sepatu_id, $detail_size, $detail_color, $qty){ //non retur  
        // dd($request->all());
        
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true);

        $detail_id = DetailSepatu::where('fk_sepatu','=',$sepatu_id)
            ->where('detail_sepatu_ukuran','=',$detail_size)
            ->where('detail_sepatu_warna','=',$detail_color)
            ->value('detail_sepatu_id');

            
        // dd($detail_id);

        if ($cartSepatu === null) {
            $cartSepatu = [];
            Cookie::queue('cartSepatu', json_encode($cartSepatu), 1209600);
        }

        // var_dump($cartSepatu);
        if(sizeof($cartSepatu) > 0){
            foreach ($cartSepatu as $c){
                if ($c['detail_id'] == $detail_id){
                    return $this->addQty($detail_id);
                }
            }
        }
            
        $sepatu = [
            "detail_id" => $detail_id, 
            "qty" => $qty
        ];

        array_push($cartSepatu, $sepatu);
        Cookie::queue('cartSepatu', json_encode($cartSepatu));
        return redirect('/cart');
    }

    public function addQty($id){
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true);
        $updatedCart = [];

        foreach ($cartSepatu as $c){
            if ($c['detail_id'] == $id){
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
            if ($cartSepatu[$i]['detail_id'] == $id && $cartSepatu[$i]['qty'] > 0) {
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
