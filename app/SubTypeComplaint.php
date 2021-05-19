<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTypeComplaint extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function tipe()
    {
        return $this->belongsTo(TypeComplaint::class, 'jenis_pengaduan_id', 'id');
    }
}
