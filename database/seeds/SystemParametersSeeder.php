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
            'menu_bg_color'=>'#607D8B',
            'menu_text_color'=>'#FFFFFF',
            'header_bg_color'=>'#FF9800',
            'header_text_color'=>'#757575',
        ]);
    }
}
