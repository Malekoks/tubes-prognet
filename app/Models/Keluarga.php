<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;
    protected $table='m_anggota_keluarga';

    protected $primaryKey = 'id_anggota_keluarga';
}
