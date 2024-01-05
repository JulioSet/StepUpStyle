<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dtrans extends Model
{
    use HasFactory;
    protected $table = "dtrans_penjualan";
    protected $fillable = [
        'fk_sepatu',
        'fk_htrans_penjualan',
        'fk_ukuran_sepatu',
        'dtrans_penjualan_qty',
        'dtrans_penjualan_price',
        'dtrans_penjualan_subtotal',
    ];
    // public $incrementing = true;
    public $timestamps = false;

    public function htrans()
    {
        return $this->belongsTo(htrans::class, 'fk_htrans_penjualan');
    }

    public function sepatu()
    {
        return $this->belongsTo(sepatu::class, 'fk_sepatu', 'sepatu_id');
    }


}
