<?php

namespace App\Http\Controllers;

use App\Charts\chartPenjualan;
use App\Http\Controllers\Controller;
use App\Models\dtrans;
use App\Models\htrans;
use App\Models\retur;
use App\Models\sepatu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class laporanController extends Controller
{
    function filterLaporanPenjualan(Request $request , chartPenjualan $chart){
        $rules = [
            'startdate' => 'required|date',
            'enddate' => 'required|date|after_or_equal:startdate',
        ];

        $messages = [
            'required' => 'Please fill this field',
            'after_or_equal' => 'End date must be equal to or after start date',
        ];

        $request->validate($rules, $messages);

        $start=$request->input('startdate');
        $end=$request->input('enddate');

        $cektanggal = htrans::whereBetween('created_at', [$start, $end])
                    ->where('htrans_penjualan_status', 2)
                    ->get();

        return view('owner.Laporan.laporanpenjualan',['listhtrans'=>$cektanggal,'chart' =>$chart->build($start, $end)]);
    }
    function viewPDF(Request $request){
        // $id = $request->query('id');
        $listdtrans = dtrans::where('fk_htrans_penjualan', $request->id)->get();
        $listhtrans = htrans::where('htrans_penjualan_id', $request->id)->get();
        // dd($request->id,$listdtrans,$listhtrans);
        $pdf = PDF::loadView('owner.Laporan.Filepdf', compact('listdtrans', 'listhtrans'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('htrans.pdf');
        
    }

    function viewPDF2(Request $request){
        // $id = $request->query('id');
        // $listdtrans = dtrans::where('fk_htrans_penjualan', $id)->get();
        // $start=$request->input('startdate');
        // $end=$request->input('enddate');
        // $listhtrans= htrans::whereBetween('created_at', [$start, $end])
        //             ->where('htrans_penjualan_status', 2)
        //             ->get();
        $listhtrans = htrans::where('htrans_penjualan_status', 2)->get();
        $pdf = PDF::loadView('owner.Laporan.FilepdfLaporanPenjualan', compact('listhtrans'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('htransPenjualan.pdf');
    }

    function viewPDF3(Request $request){
        // $id = $request->query('id');
        // $listdtrans = dtrans::where('fk_htrans_penjualan', $id)->get();
        // $start=$request->input('startdate');
        // $end=$request->input('enddate');
        // $listhtrans= htrans::whereBetween('created_at', [$start, $end])
        //             ->where('htrans_penjualan_status', 2)
        //             ->get();
        $listproduct = sepatu::all();
        $pdf = PDF::loadView('owner.Laporan.FilepdfLaporanProduct', compact('listproduct'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('htransPenjualan.pdf');
    }


    function viewPDF4(Request $request){
        // $id = $request->query('id');
        // $listdtrans = dtrans::where('fk_htrans_penjualan', $id)->get();
        // $start=$request->input('startdate');
        // $end=$request->input('enddate');
        // $listhtrans= htrans::whereBetween('created_at', [$start, $end])
        //             ->where('htrans_penjualan_status', 2)
        //             ->get();
        $listretur = retur::all();
        $pdf = PDF::loadView('owner.Laporan.FilepdfLaporanRetur', compact('listretur'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('htransPenjualan.pdf');
    }
    function filterLaporanRetur(Request $request){
        $rules = [
            'startdate' => 'required|date',
            'enddate' => 'required|date|after_or_equal:startdate',
        ];

        $messages = [
            'required' => 'Please fill this field',
            'after_or_equal' => 'End date must be equal to or after start date',
        ];

        $request->validate($rules, $messages);

        $start=$request->input('startdate');
        $end=$request->input('enddate');

        $cektanggal = retur::whereBetween('created_at', [$start, $end])
                    ->where('retur_status', 1)
                    ->get();

        return view('owner.Laporan.Laporanretur',['listretur'=>$cektanggal]);
    }
}
