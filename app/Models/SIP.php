<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sip extends Model
{
    use HasFactory;
    protected $fillable = [
        'jam_jaga',
        'tgl_jaga',
        'sertifikasi_keamanan',
    ];
}
