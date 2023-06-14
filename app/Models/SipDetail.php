<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SipDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_satpam', 
        'kd_sip', 
        'tempat_jaga',
        'seragam_jaga',
    ];

    public function getSip()
    {
        return $this->belongsTo(Sip::class, 'kd_sip', 'id');
    }
}
