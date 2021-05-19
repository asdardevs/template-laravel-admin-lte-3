<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table = 'sub_menus';

    protected $fillable = [
        'menu_id',
        'sub',
        'sub_url',
        'is_active',
        'urut_sub',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
