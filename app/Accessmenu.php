<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessmenu extends Model
{
    protected $table = 'access_menus';

    protected $fillable = [
        'menu_id',
        'role_id',
    ];


    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

     public function getCreatedAtAttribute()
{
    return \Carbon\Carbon::parse($this->attributes['created_at'])
       ->format('d-m-Y H:i:s');
}
public function getUpdatedAtAttribute()
{
    return \Carbon\Carbon::parse($this->attributes['updated_at'])
       ->format('d-m-Y H:i:s');
}
}
