<?php

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MenuItem::truncate();

        /**/
        \App\Models\MenuItem::create([
            'id' => 1,
            'menu_item_parent_id' => null,
            'group_l' => true,
            'menu_item_name' => 'МЕНЮ',
            'menu_item_code' => 'MENU',
            'url' => 'FirstMenu',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 2,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Frontend',
            'menu_item_code' => 'Frontend',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 3,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Backend',
            'menu_item_code' => 'Backend',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 4,
            'menu_item_parent_id' => 1,
            'group_l' => false,
            'menu_item_name' => 'SystemProgramming',
            'menu_item_code' => 'Системное программирование',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 5,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Tools',
            'menu_item_code' => 'Tools',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 6,
            'menu_item_parent_id' => 1,
            'group_l' => false,
            'menu_item_name' => 'GameDev',
            'menu_item_code' => 'Gamedev',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 7,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'CMS',
            'menu_item_code' => 'CMS',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 8,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Blockchain',
            'menu_item_code' => 'Blockchain',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 9,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'AnythingElse',
            'menu_item_code' => 'Другое',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);


        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"MenuItems_id_seq\"', 200, true)");

    }
}
