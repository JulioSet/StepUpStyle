<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifikasi extends Model
{
    use HasFactory;
    protected $table = "notifikasi";
    protected $primaryKey = "notifikasi_id";
    protected $fillable = [
        'notifikasi_type',
        'notifikasi_content',
        'notifikasi_status'
    ];
    public $incrementing = true;
    public $timestamps = true;
}
