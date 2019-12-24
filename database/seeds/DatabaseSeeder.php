<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AccessRolesTableSeeder::class);
         $this->call(ConsumerAccessRolesTableSeeder::class);
         $this->call(ConsumersTableSeeder::class);
         $this->call(InterfacesTableSeeder::class);
         $this->call(MenuItemsTableSeeder::class);
         $this->call(MenuItemAccessRolesTableSeeder::class);
         $this->call(SystemParametersSeeder::class);
    }
}
