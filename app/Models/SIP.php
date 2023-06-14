<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sip extends Model
{
    use HasFactory;
    protected $fillable = [
        'sesi_jaga',
        'lama_jaga',
        'sertifikasi_keamanan',
    ];
}
