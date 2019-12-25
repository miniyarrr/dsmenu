<?php

use Illuminate\Database\Seeder;

class ConsumerAccessRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ConsumerAccessRole::truncate();

        /**/
        \App\Models\ConsumerAccessRole::create([
            'id' => 1,
            'access_role_id' => 1,
            'consumer_id' => 1,
            'main_l' => true,
        ]);

        /**/
        \App\Models\ConsumerAccessRole::create([
            'id' => 2,
            'access_role_id' => 2,
            'consumer_id' => 2,
            'main_l' => true,
        ]);

        /**/
        \App\Models\ConsumerAccessRole::create([
            'id' => 3,
            'access_role_id' => 3,
            'consumer_id' => 2,
            'main_l' => false,
        ]);

        /**/
        \App\Models\ConsumerAccessRole::create([
            'id' => 4,
            'access_role_id' => 3,
            'consumer_id' => 3,
            'main_l' => true,
        ]);

        /**/
        \App\Models\ConsumerAccessRole::create([
            'id' => 5,
            'access_role_id' => 4,
            'consumer_id' => 4,
            'main_l' => true,
        ]);

        /**/
        \App\Models\ConsumerAccessRole::create([
            'id' => 6,
            'access_role_id' => 5,
            'consumer_id' => 3,
            'main_l' => true,
        ]);

        /**/
        \App\Models\ConsumerAccessRole::create([
            'id' => 7,
            'access_role_id' => 5,
            'consumer_id' => 4,
            'main_l' => true,
        ]);

        /**/
        \App\Models\ConsumerAccessRole::create([
            'id' => 8,
            'access_role_id' => 6,
            'consumer_id' => 3,
            'main_l' => true,
        ]);

        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"_ConsumerAccessRoles_id_seq\"', 2000, true)");

    }
}
