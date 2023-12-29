<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "user";
    protected $primaryKey = "user_id";
    public $incrementing = true;
    public $timestamps = true;

    public function retur()
    {
        return $this->hasMany(retur::class, 'retur_id');
    }
}
