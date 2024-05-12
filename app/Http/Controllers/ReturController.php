<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\notifikasi;
use App\Models\retur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\returnSelf;

class ReturController extends Controller
{
    public function retur(Request $req){
        $tempRetur = json_decode(Cookie::get('tempRetur'), true);
        $dtrans = dtrans::find($tempRetur['dtrans_penjualan_id']);
        $user = Session::get('userLoggedIn');

        $rules =
            [
                "qty"=>"required",
                "reason"=>"required",
                "product" => "required",
                "product.*" => "mimes:png,jpg,jpeg|max:2048",
            ];

        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken",
            "max" => "File size exceeds 2MB limit",
            "extensions" => "File is not jpg, jpeg, or png",
        ];

        $req->validate($rules, $messages);

        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($req->file("product") as $photo) {
            $namaFilePhoto  = $dtrans->htrans->htrans_penjualan_id.'-'.$dtrans->dtrans_penjualan_id.".".$photo->getClientOriginalExtension();
            $namaFolderPhoto = "retur/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        $dtrans->dtrans_penjualan_retur = 2;
        $dtrans->save();
        $retur = retur::create([
            'fk_dtrans' => $dtrans->dtrans_penjualan_id,
            'fk_customer' => $user['id'],
            'fk_sepatu' => $dtrans->detail->sepatu->sepatu_id,
            'retur_reason' => $req->reason,
            'retur_qty' => $req->qty,
            'retur_foto' => $namaFilePhoto,
            'retur_price' => $dtrans->detail->sepatu->sepatu_price * 0.6,
            'retur_status' => 2,
        ]);

        $notif = new notifikasi();
        $notif->notifikasi_content = "Ada retur dari ".$retur->user->user_email;
        $notif->save();

        return redirect('/orders');
        // return redirect('checkout-details', ['transaction'=>$dtrans->fk_htrans_penjualan]);
    }

    public function detailsRetur($retur_id){
        $retur = retur::find($retur_id);
        $userLoggedIn = Session::get('userLoggedIn');
        return view('retur-details', compact('retur', 'userLoggedIn'));
    }

    public function cancelRetur($retur_id){
        $retur = retur::find($retur_id);
        $retur->retur_status = 9;
        $retur->save();

        return redirect('/orders');
    }
}
