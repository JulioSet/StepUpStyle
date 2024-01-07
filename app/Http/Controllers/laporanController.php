<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\htrans;
use Illuminate\Http\Request;

class laporanController extends Controller
{
    function filterLaporan(Request $request){
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
        
        $cektanggal = htrans::whereBetween('created_at', [$start, $end])->get();
        
        return view('laporan.laporanpenjualan',['listhtrans'=>$cektanggal]);
    }
}
