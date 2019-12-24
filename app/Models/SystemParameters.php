<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemParameters extends Model
{
    protected $table = "SystemParameters";

    protected $primaryKey = "id";

    protected $fillable = [
        'menu_bg_color',
        'menu_text_color',
        'header_bg_color',
        'header_text_color',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
