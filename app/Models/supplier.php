<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class supplier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "supplier";
    protected $primaryKey = "supplier_id";
    public $incrementing = true;
    public $timestamps = true;

    public function sepatu()
    {
        return $this->hasMany(Sepatu::class, 'sepatu_supplier_id');
    }
}
