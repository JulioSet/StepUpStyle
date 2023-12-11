<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class retur extends Model
{
    use HasFactory;
    protected $table = "retur";
    protected $primaryKey = "retur_id";
    public $incrementing = true;
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_customer');
    }

    public function sepatu()
    {
        return $this->belongsTo(Sepatu::class, 'fk_sepatu');
    }
}
