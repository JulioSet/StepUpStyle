<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;
    protected $table = "wishlist";
    protected $primaryKey = "wishlist_id";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'fk_customer',
        'fk_sepatu',
    ];

    public function sepatu()
    {
        return $this->hasMany(Sepatu::class, 'fk_sepatu', 'sepatu_id');
    }
}
