<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class htrans extends Model
{
    use HasFactory;
    protected $table = "htrans_penjualan";
    protected $primaryKey = "htrans_penjualan_id";
    protected $fillable = [
        'htrans_penjualan_id',
        'fk_customer',
        'htrans_penjualan_total',
        'htrans_penjualan_status',
        'snap_token'
    ];
    // public $incrementing = true;
    public $timestamps = true;

    public function dtrans()
    {
        return $this->hasMany(dtrans::class, 'fk_htrans_penjualan', 'htrans_penjualan_id');
    }

    public function customer()
    {
        return $this->belongsTo(user::class, 'fk_customer', 'user_id');
    }
}
