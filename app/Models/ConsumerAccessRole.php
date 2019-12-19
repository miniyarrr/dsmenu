<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ConsumerAccessRole extends Model
{

    protected $table = "_ConsumerAccessRoles";

    protected $primaryKey = "id";

    protected $fillable = [
        'access_role_id',
        'consumer_id',
        'main_l',
    ];


    protected $casts = [
        'id' => 'integer',
        'access_role_id' => 'integer',
        'main_l' => 'boolean',
        'consumer_id' => 'integer',
    ];


    protected $hidden = [
        'remember_token',
    ];

    public function accessRoles()
    {
        return $this->hasMany('App\Models\AccessRole', 'id', 'access_role_id');
    }


    public function readAccessRoles()
    {
        return $this->hasOne('App\Models\AccessRole', 'id', 'access_role_id');
    }


    public function consumer()
    {
        return $this->hasOne('App\Models\Consumer', 'id', 'consumer_id');
    }

}
