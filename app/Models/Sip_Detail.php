<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sip_Detail extends Model
{

    use HasFactory;

    protected $fillable = [
        'no_satpam', 
        'nama_satpam', 
        'tempat_jaga',
        'hari_jaga',
    ];

    public function getSip()
    {
        return $this->belongsTo(Sip::class, 'no_satpam', 'id');
    }
}
