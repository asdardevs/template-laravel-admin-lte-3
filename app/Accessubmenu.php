<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessubmenu extends Model
{
    protected $table = 'access_sub_menus';

    protected $fillable = [
        'sub_menu_id',
        'sub_role_id',
    ];

    public function submenu()
    {
        return $this->belongsTo(Submenu::class, 'sub_menu_id', 'id');
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
