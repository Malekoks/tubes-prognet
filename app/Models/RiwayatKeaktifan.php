<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKeaktifan extends Model
{
    use HasFactory;
    protected $primaryKey = 'riwayat_keaktifan_id';
    protected $table = "t_riwayat_keaktifan";
}
