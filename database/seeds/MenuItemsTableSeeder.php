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
            'url' => 'frontend',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 3,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Backend',
            'menu_item_code' => 'Backend',
            'url' => 'backend',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 4,
            'menu_item_parent_id' => 1,
            'group_l' => false,
            'menu_item_name' => 'Системное программирование',
            'menu_item_code' => 'SystemProgramming',
            'url' => 'systemProgramming',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 5,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Tools',
            'menu_item_code' => 'Tools',
            'url' => 'tools',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 6,
            'menu_item_parent_id' => 1,
            'group_l' => false,
            'menu_item_name' => 'GameDev',
            'menu_item_code' => 'Gamedev',
            'url' => 'gamedev',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 7,
            'menu_item_parent_id' => 2,
            'group_l' => true,
            'menu_item_name' => 'CMS',
            'menu_item_code' => 'CMS',
            'url' => 'frontend/cms',
            'line_n' => 9,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 8,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Blockchain',
            'menu_item_code' => 'Blockchain',
            'url' => 'blockchain/',
            'line_n' => 7,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 9,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Другое',
            'menu_item_code' => 'AnythingElse',
            'url' => 'other',
            'line_n' => 8,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 10,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'Angular',
            'menu_item_code' => 'Angular',
            'url' => 'frontend/angular',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 11,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'TypeScript',
            'menu_item_code' => 'TypeScript',
            'url' => 'frontend/typeScript',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 12,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'HTML',
            'menu_item_code' => 'HTML',
            'url' => 'frontend/html',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 13,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'CSS',
            'menu_item_code' => 'CSS',
            'url' => 'frontend/css',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 14,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'JavaScript',
            'menu_item_code' => 'JavaScript',
            'url' => 'frontend/javaScript',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 15,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'Vue',
            'menu_item_code' => 'Vue',
            'url' => 'frontend/Vue',
            'line_n' => 6,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 16,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'React.js',
            'menu_item_code' => 'ReactJs',
            'url' => 'frontend/reactJs',
            'line_n' => 7,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 17,
            'menu_item_parent_id' => 2,
            'group_l' => false,
            'menu_item_name' => 'JQuery',
            'menu_item_code' => 'JQuery',
            'url' => 'frontend/jQuery',
            'line_n' => 8,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 18,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'PHP',
            'menu_item_code' => 'PHP',
            'url' => 'backend/php',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 19,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Python',
            'menu_item_code' => 'Python',
            'url' => 'backend/python',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 20,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Ruby on Rails',
            'menu_item_code' => 'RubyOnRails',
            'url' => 'backend/rubyOnRails',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 21,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Laravel',
            'menu_item_code' => 'Laravel',
            'url' => 'backend/laravel',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 22,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Symphony',
            'menu_item_code' => 'Symphony',
            'url' => 'backend/symphony',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 23,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Java',
            'menu_item_code' => 'Java',
            'url' => 'backend/java',
            'line_n' => 6,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 24,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'Node.js',
            'menu_item_code' => 'NodeJs',
            'url' => 'backend/nodeJs',
            'line_n' => 7,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 25,
            'menu_item_parent_id' => 3,
            'group_l' => false,
            'menu_item_name' => 'C#',
            'menu_item_code' => 'CSharp',
            'url' => 'backend/cSharp',
            'line_n' => 8,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 26,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'GraphQL',
            'menu_item_code' => 'GraphQL',
            'url' => 'tools/graphQL',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 27,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Docker',
            'menu_item_code' => 'Docker',
            'url' => 'tools/docker',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 28,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Flux',
            'menu_item_code' => 'Flux',
            'url' => 'tools/flux',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 29,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Git',
            'menu_item_code' => 'Git',
            'url' => 'tools/git',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 30,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Kubernetes',
            'menu_item_code' => 'Kubernetes',
            'url' => 'tools/kubernetes',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 31,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Gulp',
            'menu_item_code' => 'Gulp',
            'url' => 'tools/gulp',
            'line_n' => 6,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 32,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Grunt',
            'menu_item_code' => 'Grunt',
            'url' => 'tools/grunt',
            'line_n' => 7,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 33,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Visual Studio Code',
            'menu_item_code' => 'VisualStudioCode',
            'url' => 'tools/visualStudioCode',
            'line_n' => 8,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 34,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'VIM',
            'menu_item_code' => 'VIM',
            'url' => 'tools/vim',
            'line_n' => 9,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 35,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Azure',
            'menu_item_code' => 'Azure',
            'url' => 'tools/azure',
            'line_n' => 10,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 36,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Webpack',
            'menu_item_code' => 'Webpack',
            'url' => 'tools/webpack',
            'line_n' => 11,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 37,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'Google Cloud',
            'menu_item_code' => 'GoogleCloud',
            'url' => 'tools/googleCloud',
            'line_n' => 12,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 38,
            'menu_item_parent_id' => 5,
            'group_l' => false,
            'menu_item_name' => 'NPM',
            'menu_item_code' => 'NPM',
            'url' => 'tools/npm',
            'line_n' => 13,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 39,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'Wordpress',
            'menu_item_code' => 'Wordpress',
            'url' => 'frontend/cms/wordpress',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 40,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'OpenChart',
            'menu_item_code' => 'OpenChart',
            'url' => 'frontend/cms/openChart',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 41,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'Drupal',
            'menu_item_code' => 'Drupal',
            'url' => 'frontend/cms/drupal',
            'line_n' => 3,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 42,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'Joomla',
            'menu_item_code' => 'Joomla',
            'url' => 'frontend/cms/joomla',
            'line_n' => 4,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 43,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => '1C-Битрикс',
            'menu_item_code' => 'OneCBitrix',
            'url' => 'frontend/cms/oneCBitrix',
            'line_n' => 5,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 44,
            'menu_item_parent_id' => 7,
            'group_l' => false,
            'menu_item_name' => 'MODX',
            'menu_item_code' => 'MODX',
            'url' => 'frontend/cms/modx',
            'line_n' => 6,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 45,
            'menu_item_parent_id' => 8,
            'group_l' => false,
            'menu_item_name' => 'Криптовалюты',
            'menu_item_code' => 'CryptoCurrency',
            'url' => 'blockchain/cryptoCurrency',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 46,
            'menu_item_parent_id' => 8,
            'group_l' => false,
            'menu_item_name' => 'Финансы',
            'menu_item_code' => 'Finances',
            'url' => 'blockchain/finances',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 47,
            'menu_item_parent_id' => 1,
            'group_l' => true,
            'menu_item_name' => 'Тестирование меню',
            'menu_item_code' => 'TestMenu',
            'url' => 'test',
            'line_n' => 9,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 48,
            'menu_item_parent_id' => 47,
            'group_l' => false,
            'menu_item_name' => 'Разработка',
            'menu_item_code' => 'Develop',
            'url' => 'test',
            'line_n' => 1,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 49,
            'menu_item_parent_id' => 47,
            'group_l' => false,
            'menu_item_name' => 'Системмные параметры',
            'menu_item_code' => 'SystemParameters',
            'url' => 'test',
            'line_n' => 2,
        ]);

        /**/
        \App\Models\MenuItem::create([
            'id' => 50,
            'menu_item_parent_id' => 47,
            'group_l' => false,
            'menu_item_name' => 'Администрирование',
            'menu_item_code' => 'Administration',
            'url' => 'test',
            'line_n' => 3,
        ]);


        if (config("database.default") == "pgsql")
            \Illuminate\Support\Facades\DB::statement("SELECT setval('\"public\".\"MenuItems_id_seq\"', 200, true)");

    }
}
