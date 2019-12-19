<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = "MenuItems";

    protected $primaryKey = "id";

    protected $fillable = [
        'menu_item_parent_id',
        'group_l',
        'menu_item_name',
        'menu_item_code',
        'line_n',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function menuItemAccessRole()
    {
        return $this->hasMany('App\Models\MenuItemAccessRole', 'menu_item_id', 'id');
    }

    public function accessRole()
    {
        return $this->belongsTo('App\Models\AccessRole',  'id');
    }

    public function parentItem()
    {
        return $this->hasMany('App\Models\MenuItem', 'menu_item_parent_id', 'id')
            ->with('menuItemAccessRole');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'menu_item_parent_id');
    }







}