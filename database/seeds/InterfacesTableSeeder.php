<?php

use Illuminate\Database\Seeder;

class InterfacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UInterface::truncate();

        /**/
        \App\Models\UInterface::create([
            'id' => 1,
            'menu_item_id' => 1,
            'interface_code' => 'Test',
            'interface_name' => 'Тест',
        ]);

        /**/
        \App\Models\UInterface::create([
            'id' => 2,
            'menu_item_id' => 1,
            'interface_code' => 'AlexMiniyar',
            'interface_name' => 'Саша и Минияр',
        ]);

        /**/
        \App\Models\UInterface::create([
            'id' => 3,
            'menu_item_id' => 1,
            'interface_code' => 'Alex',
            'interface_name' => 'Саша',
        ]);

        /**/
        \App\Models\UInterface::create([
            'id' => 4,
            'menu_item_id' => 1,
            'interface_code' => 'Dima',
            'interface_name' => 'Дима',
        ]);

        /**/
        \App\Models\UInterface::create([
            'id' => 5,
            'menu_item_id' => 1,
            'interface_code' => 'AlexDima',
            'interface_name' => 'Саша и Дима',
        ]);

        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"__UserInterfaces_id_seq\"', 2000, true)");

    }
}
