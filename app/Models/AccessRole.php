<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AccessRole extends Model {
  
    protected $table = "_AccessRoles";

    protected $primaryKey = "id";

    protected $fillable = [
        'interface_id',
        'access_role_code',
        'access_role_name'
    ];
    
    
    protected $casts = [
        'id' => 'integer',
        'access_role_code' => 'string',
        'access_role_name' => 'string',
    ];
    

    protected $hidden = [
        'remember_token',
    ];

}
