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
        $rows = $request->menu_items;

        DB::beginTransaction();

        foreach ($rows as $row){
            try {
                MenuItem::where('id', $row['id'])->update(['menu_item_name' => $row['menu_item_name'],
                    'menu_item_code' => $row['menu_item_code'],
                    'url' => $row['url'],
                    'line_n' => $row['line_n']]);
            }
            catch (\Exception $ex){
                $res = [
                    "message" => $ex->getMessage(),
                    "status_code"  => $ex->getCode()
                ];
                DB::rollBack();
                return response()->json($res);
            }
        }

        DB::commit();

        $res = [
            "message" => 'Saved',
            "status_code"  => '200'
        ];

        return response()->json($res);
    }

}
