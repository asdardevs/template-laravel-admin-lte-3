<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'angkatan',
        'kelas_id',
        'user_id',

    ];

    public function kelas()
    {
        return $this->belongsTo(Classroom::class, 'kelas_id', 'id');
    }
}
