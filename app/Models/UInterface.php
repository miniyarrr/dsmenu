<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UInterface extends Model
{
    protected $table = "__UserInterfaces";

    protected $primaryKey = "id";

    protected $fillable = [
        'menu_item_id',
        'interface_code',
        'interface_name',
    ];

    protected $hidden = [
        'remember_token',
    ];


    public function menuItemLeft(){
        return $this->hasOne('App\Models\MenuItem', 'id', 'menu_item_id_left');
    }

    public function menuItemTop()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'menu_item_id_top');
    }

    public function menuItem()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'menu_item_id');
    }

    public function accessRoles()
    {
        return $this->hasMany('App\Models\AccessRole', 'user_interface_id', 'id');
    }
}
