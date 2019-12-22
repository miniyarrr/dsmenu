<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consumer extends Authenticatable
{
    use Notifiable;


    protected $table = "Consumers";
    protected $primaryKey = "id";

    protected $fillable = [
        'consumer_login',
        'password',
        'consumer_name',
        'first_name',
        'last_name',
        'middle_name',
    ];

    protected $hidden = [
        /*'consumer_pass',*/
        'remember_token',
    ];

    protected $casts = [
        'consumer_id'          => 'integer',
        'consumer_login'       => 'string',
        'password'             => 'string',
        'consumer_name'        => 'string',
        'first_name'           => 'string',
        'last_name'            => 'string',
        'middle_name'          => 'string',

    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

    public function consumerAccessRoles()
    {
        return $this->hasMany('App\Models\ConsumerAccessRole', 'consumer_id', 'id'); //
    }

    public function getDisplayName()
    {
        return $this->getAttributeValue("consumer_name");
    }

    public function getUserInterfaces()
    {
        $consumer_id = $this->getAttributeValue("id");

        if(is_null($consumer_id))
            return null;

        if(config("database.default") == "mysql")
        {
            $data = DB::table('__UserInterfaces as ui')->whereRaw('ui.id IN (select ar.user_interface_id 
                                                from _AccessRoles as ar
                                                where ar.id in (select car.access_role_id 
                                                    from _ConsumerAccessRoles as car 
                                                    where consumer_id = ' . $consumer_id . '))')
                ->select('id', 'user_interface_name as name', 'home_url')->orderBy('id', 'asc')->get()->toArray();
        }

        elseif(config("database.default") == "pgsql")
        {
            $data = DB::table('__UserInterfaces as ui')->whereRaw('ui.id IN (select ar.interface_id 
                                                from "_AccessRoles" as ar
                                                where ar.id in (select car.access_role_id 
                                                    from "_ConsumerAccessRoles" as car 
                                                    where consumer_id = ' . $consumer_id . '))')
                ->select('id', 'interface_name as name')->orderBy('id', 'asc')->get()->toArray();
        }

        $data = json_decode(json_encode($data), true);
        return $data;
    }
}


