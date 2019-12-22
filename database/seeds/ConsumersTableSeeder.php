<?php

use Illuminate\Database\Seeder;

class ConsumersTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Consumer::truncate();

        /**/
        \App\Models\Consumer::create([
            'id' => 1,
            'consumer_login' => 'test@test.com',
            'password' => '$2y$10$lxS5YZfJuhLQkw12EGxnzeE3kjPUWn2px4rFFTum6fwMn56DFGgm.',
            'consumer_name' => 'Тест',
            'first_name' => NULL,
            'last_name' => NULL,
            'middle_name' => NULL,
            'created_at' => '2019-12-22 12:00:00',
            'updated_at' => '2019-12-22 12:00:00',
        ]);

        /**/
        \App\Models\Consumer::create([
            'id' => 2,
            'consumer_login' => 'miniyar@test.com',
            'password' => '$2y$10$lxS5YZfJuhLQkw12EGxnzeE3kjPUWn2px4rFFTum6fwMn56DFGgm.',
            'consumer_name' => 'Минияр',
            'first_name' => NULL,
            'last_name' => NULL,
            'middle_name' => NULL,
            'created_at' => '2019-12-22 12:00:00',
            'updated_at' => '2019-12-22 12:00:00',
        ]);

        /**/
        \App\Models\Consumer::create([
            'id' => 3,
            'consumer_login' => 'alex@test.com',
            'password' => '$2y$10$lxS5YZfJuhLQkw12EGxnzeE3kjPUWn2px4rFFTum6fwMn56DFGgm.',
            'consumer_name' => 'Александр',
            'first_name' => NULL,
            'last_name' => NULL,
            'middle_name' => NULL,
            'created_at' => '2019-12-22 12:00:00',
            'updated_at' => '2019-12-22 12:00:00',
        ]);

        /**/
        \App\Models\Consumer::create([
            'id' => 4,
            'consumer_login' => 'dima@test.com',
            'password' => '$2y$10$lxS5YZfJuhLQkw12EGxnzeE3kjPUWn2px4rFFTum6fwMn56DFGgm.',
            'consumer_name' => 'Дмитрий',
            'first_name' => NULL,
            'last_name' => NULL,
            'middle_name' => NULL,
            'created_at' => '2019-12-22 12:00:00',
            'updated_at' => '2019-12-22 12:00:00',
        ]);

        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"Consumers_id_seq\"', 2000, true)");

    }
}
