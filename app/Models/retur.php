<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retur extends Model
{
    use HasFactory;
    protected $table = "retur";
    protected $primaryKey = "retur_id";
    public $incrementing = true;
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(user::class, 'fk_customer');
    }

    public function sepatu()
    {
        return $this->belongsTo(sepatu::class, 'fk_sepatu');
    }
}
