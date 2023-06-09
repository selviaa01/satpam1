<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIP_Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_satpam',
        'id_satpam',
        'tanggal_jaga',
        'tempat_jaga',
        'sesi_jaga'
    ];
}
