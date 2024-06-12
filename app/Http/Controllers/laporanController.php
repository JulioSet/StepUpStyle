<?php

namespace App\Http\Controllers;

use App\Charts\chartPenjualan;
use App\Http\Controllers\Controller;
use App\Models\htrans;
use App\Models\retur;
use Illuminate\Http\Request;

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
