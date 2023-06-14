<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satpam extends Model
{
    use HasFactory;

    protected $fillable = [
        'kd_satpam', 
        'nama_satpam', 
        'tgl_jaga',
    ];

    public function detail()
    {
        return $this->hasMany(SipDetail::class, 'kd_satpam', 'kd_satpam');
    }

    public function getManager()
    {
        return $this->belongsTo(User::class, 'nama_satpam', 'id');
    }
}
