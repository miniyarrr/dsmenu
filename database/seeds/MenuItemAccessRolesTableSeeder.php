<?php

use Illuminate\Database\Seeder;

class MenuItemAccessRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MenuItemAccessRole::truncate();

        /**/
        \App\Models\MenuItemAccessRole::create([
            'id' => 1,
            'menu_item_id' => 1,
            'access_role_id' => 1,
            'menu_item_view_l' => true,
        ]);

        /**/
        \App\Models\MenuItemAccessRole::create([
            'id' => 2,
            'menu_item_id' => 2,
            'access_role_id' => 2,
            'menu_item_view_l' => true,
        ]);

        /**/
        \App\Models\MenuItemAccessRole::create([
            'id' => 3,
            'menu_item_id' => 1,
            'access_role_id' => 3,
            'menu_item_view_l' => true,
        ]);

        /**/
        \App\Models\MenuItemAccessRole::create([
            'id' => 4,
            'menu_item_id' => 1,
            'access_role_id' => 4,
            'menu_item_view_l' => true,
        ]);

        /**/
        \App\Models\MenuItemAccessRole::create([
            'id' => 5,
            'menu_item_id' => 4,
            'access_role_id' => 3,
            'menu_item_view_l' => false,
        ]);

        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"MenuItemAccessRoles_id_seq\"', 2000, true)");

    }
}
