<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStruktural extends Model
{
    use HasFactory;
    protected $primaryKey = 'riwayat_struktural_id';
    protected $table = "t_riwayat_struktural";
}
