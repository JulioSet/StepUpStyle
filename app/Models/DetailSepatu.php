<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailSepatu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "detail_sepatu";
    protected $primaryKey = "detail_sepatu_id";
    public $incrementing = true;
    public $timestamps = true;

    public function sepatu()
    {
        return $this->belongsTo(sepatu::class, 'fk_sepatu');
    }
}
