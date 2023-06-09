<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIP extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_satpam',
        'tanggal_jaga',
        'tempat_jaga',
        'sesi_jaga'
    ];
}
