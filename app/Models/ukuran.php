<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ukuran extends Model
{
    use HasFactory;
    protected $table = "ukuran";
    protected $primaryKey = "ukuran_sepatu_id";
    public $incrementing = true;
    public $timestamps = true;
}
