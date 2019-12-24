<?php


namespace App\Http\Controllers;

use App\Http\Classes\StoredFileManager;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MenuItemAccessRolesController;
use App\Models\AccessRole;
use App\Models\Consumer;
use App\Models\ConsumerAccessRole;
use App\Models\MenuItem;
use App\Models\MenuItemAccessRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Arr;
use App\Http\Classes\MenuManager;
use Illuminate\Support\Facades\Route;

class MenuItemsController extends Controller
{
    public function list(Request $request)
    {
        $params = [
            'check_access' => false,
            'convert_to_list' => true,
            'indentation' => [
                'indent' => 10
            ],
            'fields_list' => [
                'id',
                'menu_item_code',
                'title',
                'line_n',
                'padding',
                'url'
            ],
        ];

        $ModelTables = (new MenuManager())->buildMenu($params);

        $list = [
            "main_data_models" => [
                "MenuItems" => $ModelTables,
            ],
            "form_parameters"  => [
                "form_title"                    => "Пункты меню",
                "form_code"                     => "MenuItems",
            ],
        ];

        return response()->json($list);


    }

    public function update(Request $request)
    {
        $params = [
            'check_access' => false,
            'convert_to_list' => true,
            'indentation' => [
                'marker' => '- ',
                'indent' => 15,
            ],
            'fields_list' => [
                'id',
                'menu_item_code',
                'title',
                'line_n',
                'padding'
            ],
        ];

        $ModelTables = (new MenuManager())->buildMenu($params);

        $list = [
            "main_data_models" => [
                "MenuItems" => $ModelTables,
            ],
            "form_parameters"  => [
                "form_title"                    => "Пункты меню",
                "form_code"                     => "MenuItems",
            ],
            "tabs"             => [
//                [
//                    "tab_title" => $getArrayCaptions['Main']['translation_captions']['caption_translation'],
//                    "blocks_quantity" => 1,
//                    "blocks"          => [
//                        [
//                            "block_zone_quantity" => 1, //add Albert Topalu
//                            "block_model"         => $controller->controller_alias,
//                            "block_type"          => "block_list_base",
//                            "block_fields"        => [
//                                ['key'      => 'actions', 'type'    => 'checkbox',
//                                    'sortable' => false,
//                                    'class'    => 'list_checkbox',
//                                    'thStyle'  => 'width: 5%',
//                                    "zone"     => "1",
//                                    "order"    => "1"
//                                ],
//                                [
//                                    'key'       => 'line_n',
//                                    'sortable'  => false,
//                                    'class'     => 'line_n',
//                                    'label'     => $getArrayCaptions['LineNumber']['translation_captions']['caption_translation'],
//                                    'thStyle'   => 'width: 5%',
//                                    "zone"      => "1",
//                                    "order"     => "2"
//                                ],
//                                [
//                                    'key'       => 'title',
//                                    'sortable'  => false,
//                                    'class'     => 'title',
//                                    'label'     => $getArrayCaptions['Name']['translation_captions']['caption_translation'],
//                                    'thStyle'   => 'width: 30%',
//                                    "zone"      => "1",
//                                    "order"     => "3",
//                                    'type'      => 'html',
//                                ],
//                                [
//                                    'key'       => 'menu_item_code',
//                                    'sortable'  => false,
//                                    'class'     => 'menu_item_code',
//                                    'label'     => $getArrayCaptions['Code']['translation_captions']['caption_translation'],
//                                    'thStyle'   => 'width: 22%',
//                                    "zone"      => "1",
//                                    "order"     => "4"
//                                ],
//                                [
//                                    'key'       => 'access_allowed_role_name',
//                                    'sortable'  => false,
//                                    'class'     => 'access_allowed_role_name',
//                                    'label'     => $getArrayCaptions['RoleAccess']['translation_captions']['caption_translation'],
//                                    'thStyle'   => 'width: 19%',
//                                    "zone"      => "1",
//                                    "order"     => "5"
//                                ],
//                                [
//                                    'key'       => 'access_denied_role_name',
//                                    'sortable'  => false,
//                                    'class'     => 'access_denied_role_name',
//                                    'label'     => $getArrayCaptions['RoleForbidden']['translation_captions']['caption_translation'],
//                                    'thStyle'   => 'width: 19%',
//                                    "zone"      => "1",
//                                    "order"     => "4"
//                                ],
//                            ]
//                        ]
//                    ]
//                ],
            ]
        ];

        return response()->json($list);

    }

}
