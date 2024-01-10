<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sepatu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "sepatu";
    protected $primaryKey = "sepatu_id";
    public $incrementing = true;
    public $timestamps = true;

    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'sepatu_supplier_id');
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'sepatu_kategori_id');
    }

    public function ukuran()
    {
        return $this->belongsTo(ukuran::class, 'sepatu_ukuran_id');
    }
}
