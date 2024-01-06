<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retur extends Model
{
    use HasFactory;
    protected $table = "retur";
    protected $primaryKey = "retur_id";
    protected $fillable = [
        'fk_dtrans',
        'retur_reason',
        'retur_qty',
        'retur_foto',
        'retur_price',
        'retur_status'
    ];
    public $incrementing = true;
    public $timestamps = true;

    public function dtrans()
    {
        return $this->belongsTo(dtrans::class, 'fk_dtrans');
    }
}
