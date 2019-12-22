<?php

use Illuminate\Database\Seeder;

class AccessRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AccessRole::truncate();

        /**/
        \App\Models\AccessRole::create([
            'id' => 1,
            'interface_id' => 1,
            'access_role_code' => 'Test',
            'access_role_name' => 'Тест',
        ]);

        /**/
        \App\Models\AccessRole::create([
            'id' => 2,
            'interface_id' => 2,
            'access_role_code' => 'Test',
            'access_role_name' => 'Минияр',
        ]);

        /**/
        \App\Models\AccessRole::create([
            'id' => 3,
            'interface_id' => 3,
            'access_role_code' => 'AlexMiniyar',
            'access_role_name' => 'Саша и Минияр',
        ]);

        /**/
        \App\Models\AccessRole::create([
            'id' => 4,
            'interface_id' => 4,
            'access_role_code' => 'Dima',
            'access_role_name' => 'Дима',
        ]);

        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"_AccessRoles_id_seq\"', 2000, true)");

    }
}
