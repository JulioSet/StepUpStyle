<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    protected $table = "kategori";
    protected $primaryKey = "kategori_id";
    public $incrementing = true;
    public $timestamps = true;

    public function sepatu()
    {
        return $this->hasMany(Sepatu::class, 'sepatu_kategori_id');
    }
}
