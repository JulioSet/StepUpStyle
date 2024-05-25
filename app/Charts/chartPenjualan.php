<?php

namespace App\Charts;

use App\Models\htrans;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class chartPenjualan
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($startDate = null, $endDate = null): \ArielMejiaDev\LarapexCharts\LineChart
    {
        if (is_null($startDate)) {
            $start = Htrans::orderBy('created_at')->first()->created_at ?? Carbon::now()->startOfYear();
        } else {
            $start = Carbon::parse($startDate)->startOfDay();
        }
    
        if (is_null($endDate)) {
            $end = Carbon::now()->endOfDay();
        } else {
            $end = Carbon::parse($endDate)->endOfDay();
        }
    
        $salesData = Htrans::where('htrans_penjualan_status', 2)
            ->whereBetween('created_at', [$start, $end])
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('d');
            })
            ->map(function ($day) {
                return $day->sum('htrans_penjualan_total');
            });
    
        $dailySales = [];
        $days = [];
        foreach ($salesData as $day => $total) {
            $days[] = $day;
            $dailySales[] = $total;
        }
    
        if (empty($dailySales)) {
            $dailySales = [0];
            $days = [$start->format('d')];
        }
    
        return $this->chart->lineChart()
            ->setTitle('Grafik Penjualan Harian')
            ->setHeight(300)
            ->addData('Total Sales', $dailySales)
            ->setXAxis($days);
    }
}
