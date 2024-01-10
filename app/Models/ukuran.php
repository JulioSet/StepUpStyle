<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ukuran extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "ukuran";
    protected $primaryKey = "ukuran_sepatu_id";
    public $incrementing = true;
    public $timestamps = true;

    public function sepatu()
    {
        return $this->belongsTo(sepatu::class, 'sepatu_ukuran_id');
    }
}
