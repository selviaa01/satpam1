<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satpam extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_satpam', 
        'nama_satpam', 
        'no_hp',
        'bahasa',
    ];
}
