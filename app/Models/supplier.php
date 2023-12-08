<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $table = "supplier";
    protected $primaryKey = "supplier_id";
    public $incrementing = true;
    public $timestamps = true;

    public function sepatu()
    {
        return $this->hasMany(Sepatu::class, 'sepatu_supplier_id');
    }
}
