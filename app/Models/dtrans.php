<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dtrans extends Model
{
    use HasFactory;
    protected $table = "dtrans_penjualan";
    protected $primaryKey = "dtrans_penjualan_id";
    protected $fillable = [
        'fk_detail_sepatu',
        'fk_htrans_penjualan',
        'fk_ukuran_sepatu',
        'dtrans_penjualan_qty',
        'dtrans_penjualan_price',
        'dtrans_penjualan_subtotal',
    ];
    public $incrementing = true;
    public $timestamps = false;

    public function htrans()
    {
        return $this->belongsTo(htrans::class, 'fk_htrans_penjualan');
    }

    public function detail()
    {
        return $this->belongsTo(DetailSepatu::class, 'fk_detail_sepatu', 'detail_sepatu_id');
    }
    // public function details()
    // {
    // return $this->hasMany(DetailSepatu::class, 'fk_dtrans_penjualan', 'dtrans_penjualan_id');
    // }
    
    public function sepatu()
    {
        return $this->hasOneThrough(Sepatu::class, DetailSepatu::class, 'detail_sepatu_id', 'sepatu_id', 'fk_detail_sepatu', 'fk_sepatu');
    }


}
