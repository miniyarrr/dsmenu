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
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 4,
            'menu_item_parent_id' => 1,
            'group_l' => false,
            'menu_item_name' => 'Системное программирование',
            'menu_item_code' => 'SystemProgramming',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 5,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Tools',
            'menu_item_code' => 'Tools',
            'url' => 'menuItems',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 6,
            'menu_item_parent_id' => 1,
            'group_l' => false,
            'menu_item_name' => 'GameDev',
            'menu_item_code' => 'Gamedev',
            'url' => 'menuItems',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 7,
            'menu_item_parent_id' => 2,
            'group_l' => true,
            'menu_item_name' => 'CMS',
            'menu_item_code' => 'CMS',
            'url' => 'menuItems',
            'line_n' => 9,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 8,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Blockchain',
            'menu_item_code' => 'Blockchain',
            'url' => 'menuItems',
            'line_n' => 7,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 9,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Другое',
            'menu_item_code' => 'AnythingElse',
            'url' => 'menuItems',
            'line_n' => 8,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 10,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'Angular',
            'menu_item_code' => 'Angular',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 11,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'TypeScript',
            'menu_item_code' => 'TypeScript',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 12,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'HTML',
            'menu_item_code' => 'HTML',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 13,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'CSS',
            'menu_item_code' => 'CSS',
            'url' => 'menuItems',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 14,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'JavaScript',
            'menu_item_code' => 'JavaScript',
            'url' => 'menuItems',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 15,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'Vue',
            'menu_item_code' => 'Vue',
            'url' => 'menuItems',
            'line_n' => 6,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 16,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'React.js',
            'menu_item_code' => 'ReactJs',
            'url' => 'menuItems',
            'line_n' => 7,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 17,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'JQuery',
            'menu_item_code' => 'JQuery',
            'url' => 'menuItems',
            'line_n' => 8,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 18,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'PHP',
            'menu_item_code' => 'PHP',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 19,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Python',
            'menu_item_code' => 'Python',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 20,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Ruby on Rails',
            'menu_item_code' => 'RubyOnRails',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 21,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Laravel',
            'menu_item_code' => 'Laravel',
            'url' => 'menuItems',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 22,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Symphony',
            'menu_item_code' => 'Symphony',
            'url' => 'menuItems',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 23,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Java',
            'menu_item_code' => 'Java',
            'url' => 'menuItems',
            'line_n' => 6,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 24,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Node.js',
            'menu_item_code' => 'NodeJs',
            'url' => 'menuItems',
            'line_n' => 7,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 25,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'C#',
            'menu_item_code' => 'CSharp',
            'url' => 'menuItems',
            'line_n' => 8,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 26,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'GraphQL',
            'menu_item_code' => 'GraphQL',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 27,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Docker',
            'menu_item_code' => 'Docker',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 28,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Flux',
            'menu_item_code' => 'Flux',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 29,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Git',
            'menu_item_code' => 'Git',
            'url' => 'menuItems',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 30,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Kubernetes',
            'menu_item_code' => 'Kubernetes',
            'url' => 'menuItems',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 31,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Gulp',
            'menu_item_code' => 'Gulp',
            'url' => 'menuItems',
            'line_n' => 6,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 32,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Grunt',
            'menu_item_code' => 'Grunt',
            'url' => 'menuItems',
            'line_n' => 7,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 33,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Visual Studio Code',
            'menu_item_code' => 'VisualStudioCode',
            'url' => 'menuItems',
            'line_n' => 8,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 34,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'VIM',
            'menu_item_code' => 'VIM',
            'url' => 'menuItems',
            'line_n' => 9,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 35,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Azure',
            'menu_item_code' => 'Azure',
            'url' => 'menuItems',
            'line_n' => 10,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 36,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Webpack',
            'menu_item_code' => 'Webpack',
            'url' => 'menuItems',
            'line_n' => 11,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 37,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Google Cloud',
            'menu_item_code' => 'GoogleCloud',
            'url' => 'menuItems',
            'line_n' => 12,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 38,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'NPM',
            'menu_item_code' => 'NPM',
            'url' => 'menuItems',
            'line_n' => 13,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 39,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'Wordpress',
            'menu_item_code' => 'Wordpress',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 40,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'OpenChart',
            'menu_item_code' => 'OpenChart',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 41,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'Drupal',
            'menu_item_code' => 'Drupal',
            'url' => 'menuItems',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 42,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'Joomla',
            'menu_item_code' => 'Joomla',
            'url' => 'menuItems',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 43,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => '1C-Битрикс',
            'menu_item_code' => 'OneCBitrix',
            'url' => 'menuItems',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 44,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'MODX',
            'menu_item_code' => 'MODX',
            'url' => 'menuItems',
            'line_n' => 6,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 45,
            'menu_item_parent_id' => 8,
            'group_l' => false,
            'menu_item_name' => 'Криптовалюты',
            'menu_item_code' => 'CryptoCurrency',
            'url' => 'menuItems',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 46,
            'menu_item_parent_id' => 8,
            'group_l' => false,
            'menu_item_name' => 'Финансы',
            'menu_item_code' => 'Finances',
            'url' => 'menuItems',
            'line_n' => 2,
        ]);


        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"MenuItems_id_seq\"', 200, true)");

    }
}
