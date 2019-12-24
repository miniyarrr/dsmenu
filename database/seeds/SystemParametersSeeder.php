<?php

use Illuminate\Database\Seeder;

class SystemParametersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SystemParameters::truncate();

        \App\Models\SystemParameters::create([
            'id' => 1,
            'menu_bg_color'=>'#000',
            'menu_text_color'=>'#fff',
            'header_bg_color'=>'#000',
            'header_text_color'=>'#fff',
        ]);
    }
}
