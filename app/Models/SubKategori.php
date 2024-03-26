<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubKategori extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "subkategori";
    protected $primaryKey = "subkategori_id";
    public $incrementing = true;
    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'fk_kategori');
    }
}
