<?php


namespace App\Http\Controllers;

use App\Http\Classes\StoredFileManager;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MenuItemAccessRolesController;
use App\Http\Controllers\NotificationsController;
use App\Models\AccessRole;
use App\Models\Consumer;
use App\Models\ConsumerAccessRole;
use App\Models\MenuItem;
use App\Models\MenuItemAccessRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Translation;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Arr;
use App\Http\Classes\MenuManager;

class MenuController extends Controller
{

    public $consumer;

    /*method returns JSON for build menu and other objects*/
    public function index(Request $request)
    {

        $this->consumer = Auth::user();
        $menu = array();
        $lang = config('app.locale');

        $params = [
            "check_access" => true,
            "convert_to_list" => false,
            "interface_id" => $request->interface_id ?? null,
        ];

        $menu = (new MenuManager())->buildMenu($params);


        return response()->json($menu, (empty($menu)) ? 403 : 200);

    }

    public function getInterfaces(Request $request){
        $this->consumer = Auth::user();
        $consumer_interfaces = $this->consumer->getUserInterfaces();

        return $consumer_interfaces;
    }
}
