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
            'menu_item_name' => 'Первое меню',
            'menu_item_code' => 'FirstMenu',
            'url' => 'FirstMenu',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 2,
            'menu_item_parent_id' => null,
            'group_l' => true,
            'menu_item_name' => 'Второе меню',
            'menu_item_code' => 'SecondMenu',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 3,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Тест 1 1',
            'menu_item_code' => 'Test11',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 4,
            'menu_item_parent_id' => 1,
            'group_l' => false,
            'menu_item_name' => 'Тест 1 2',
            'menu_item_code' => 'Test12',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 5,
            'menu_item_parent_id' => 1,
            'group_l' => false,
            'menu_item_name' => 'Тест 1 3',
            'menu_item_code' => 'Test13',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 6,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Тест 1 1 1',
            'menu_item_code' => 'Test111',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 7,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Тест 1 1 2',
            'menu_item_code' => 'Test112',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 8,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Тест 1 1 3',
            'menu_item_code' => 'Test113',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 9,
            'menu_item_parent_id' => 2,
            'group_l' => true,
            'menu_item_name' => 'Тест 2 1',
            'menu_item_code' => 'Test21',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 10,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'Тест 2 2',
            'menu_item_code' => 'Test22',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 11,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'Тест 2 3',
            'menu_item_code' => 'Test23',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 12,
            'menu_item_parent_id' => 9,
            'group_l' => false,
            'menu_item_name' => 'Тест 2 1 1',
            'menu_item_code' => 'Test211',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 13,
            'menu_item_parent_id' => 9,
            'group_l' => false,
            'menu_item_name' => 'Тест 2 1 2',
            'menu_item_code' => 'Test212',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 14,
            'menu_item_parent_id' => 9,
            'group_l' => false,
            'menu_item_name' => 'Тест 2 1 3',
            'menu_item_code' => 'Test213',
            'url' => 'Test213',
            'line_n' => 3,
        ]);

        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"MenuItems_id_seq\"', 2000, true)");

    }
}
