<?php

namespace App\Http\Classes;

use App\Models\ConsumerAccessRole;
use App\Models\MenuItem;
use App\Models\UInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function Sodium\add;

class MenuManager
{
    private static $accessRolesId = null;
    private static $menuItemTable = [];
    private static $check_access = true;
    private static $fields_list = null;
    private static $indent = 0;
    private static $marker = '';

    public function buildMenu($request)
    {
        if (isset($request['check_access'])) {
            self::$check_access = $request['check_access'];
        }

        $convert_to_list = false;
        if (isset($request['convert_to_list'])) {
            $convert_to_list = $request['convert_to_list'];
        }

        $interface_id = null;
        $userInterface = null;
        if (array_key_exists ('interface_id', $request)){
            $interface_id = $request['interface_id'];
            if ($interface_id == NULL) {
                $userInterfaces = Auth::user()->getUserInterfaces();

                if ($userInterfaces != NULL) {
                    $interface_id = $userInterfaces[0]['id'];
                }
            }
        }


        if (isset($request['fields_list'])){
            self::$fields_list = $request['fields_list'];
        }
        else{
            self::$fields_list = [
                'title',
                'depth',
                'link',
                'group_l',
                'separator'
            ];
        }

        if(isset($request['indentation'])){
            $indentation = true;
            if(isset($request['indentation']['marker'])){
                self::$marker = $request['indentation']['marker'];
            }
            if (isset($request['indentation']['indent'])){
                self::$indent = $request['indentation']['indent'];
            }
        }

        if (self::$check_access) {
            $userInterface = UInterface::where('id', $interface_id)->first();
            self::$accessRolesId = ConsumerAccessRole::leftJoin('_AccessRoles as ar', 'ar.id', '=', 'access_role_id')
                ->where('ar.interface_id', $interface_id)->where('consumer_id', Auth::user()->id)->select('ar.*')->get()->toArray();
        }
        else{
            self::$accessRolesId = null;
        }

        $menuItemTableUnNum = MenuItem::with(['menuItemAccessRole' => function ($query) use ($interface_id){
            $query->rightJoin('_AccessRoles as ar', 'ar.id', '=', 'MenuItemAccessRoles.access_role_id')->select('MenuItemAccessRoles.menu_item_id', 'ar.id as access_role_id', 'ar.access_role_name', 'menu_item_view_l');
        }])->orderBy('id')->get()->toArray();

        foreach ($menuItemTableUnNum as $key => $value) {
            $new_menu_item_access_role = [];
            foreach ($value['menu_item_access_role'] as $menu_item_access_role_key => $menu_item_access_role_value) {
                $new_menu_item_access_role[$menu_item_access_role_value['access_role_id']]=$menu_item_access_role_value;
            }
            $value['menu_item_access_role'] = $new_menu_item_access_role;
            self::$menuItemTable[$value['id']]=$value;
        }

        $menu_item_id = NULL;

        $menu_item_id = self::$check_access ? $userInterface['menu_item_id'] : 1;

        if ($menu_item_id == NULL) {
            return [];
        }

        $params = [
            'depth' => 0,
            'menuItem' => '',
        ];

        //+Menu access
        $menu = [];
        $menuItem = self::$menuItemTable[$menu_item_id];
        if (self::$check_access) {
            $menu_view_l = self::checkMenuItemAccess($menuItem, self::$accessRolesId, false);
        }
        else {
            $menu_view_l = true;
        }
        //-

        //+Menu
        if (!$menu_view_l)
            return [];

        $kids = collect(Arr::where(self::$menuItemTable, function ($value, $key) use ($menu_item_id) {
            return $value['menu_item_parent_id'] == $menu_item_id;
        }))->sortBy('line_n')->toArray();
        $items = [];
        foreach ($kids as $kid) {
            $kidAccess = NULL;
            if (self::$check_access) {
                $kidAccess = self::checkMenuItemAccess($kid, self::$accessRolesId, false);
            }
            else {
                $kidAccess = true;
            }
            if ($kidAccess === true || $kidAccess === NULL) {
                $params['menuItem'] = $kid;
                array_push($items, $this->buildMenuItem($params));
            }

        }
        $menu = [
            "items" => $items,
        ];
        //-

        if ($convert_to_list){
            $menu = $this->convertMenuToList($menu['items']);
        }

        return $menu;
    }

    private function buildMenuItem($params)
    {
        //+Устанавливаем вспомогательные параметры
        $menuItem = $params['menuItem'];
        $depth = $params['depth'];
        $depth++;
        //-Устанавливаем вспомогательные параметры

        $item = array();

        foreach (self::$fields_list as $test) {
            switch ($test) {
                case($test == 'id'):
                    $id = $menuItem['id'];
                    $item = Arr::add($item, "id", $id);
                    break;
                case($test == 'menu_item_code'):
                    $menu_item_code = $menuItem['menu_item_code'];
                    $item = Arr::add($item, "menu_item_code", $menu_item_code);
                    break;
                case($test == 'access_allowed_role_name'):
                    $access_allowed_role_name = '';
                    foreach ($menuItem['menu_item_access_role'] as $access_role) {
                        if ($access_role['menu_item_view_l'] == true)
                            $access_allowed_role_name = $access_allowed_role_name . $access_role['access_role']['access_role_name'] . ', ';
                    }
                    $access_allowed_role_name   = Str::replaceLast(', ', '', $access_allowed_role_name);
                    $item = Arr::add($item, "access_allowed_role_name", $access_allowed_role_name);
                    break;
                case($test == 'access_denied_role_name'):
                    $access_denied_role_name  = '';
                    foreach ($menuItem['menu_item_access_role'] as $access_role) {
                        if ($access_role['menu_item_view_l'] != true)
                            $access_denied_role_name  = $access_denied_role_name  . $access_role['access_role_name'] . ', ';
                    }
                    $access_denied_role_name    = Str::replaceLast(', ', '', $access_denied_role_name );
                    $item = Arr::add($item, "access_denied_role_name",  $access_denied_role_name );
                    break;
                case($test == 'image'):
                    $image = '';
                    if ($menuItem['image_id'] == NULL) {
                        if ($menuItem['group_l'] == 1) {
                            $image = '/img/interfacedashboard/folder.svg';
                        } else {
                            $image = '/img/interfacedashboard/file.svg';
                        }
                    } else {
                        $image = $menuItem['image']['image_path'];
                    }
                    $item = Arr::add($item, "img", $image);
                    break;
                case($test == 'depth'):
                    $item = Arr::add($item, "depth", $depth);
                    break;
                case($test == 'padding'):
                    $item = Arr::add($item, "padding", ($depth - 1) * self::$indent);
                    break;
                case($test == 'link'):
                    $link = '';
//                    if ($menuItem['group_l'] == 0 && $menuItem['fe_route'] != NULL) {
//                        foreach ($menuItem['fe_route']['fe_route_url'] as $fe_route_url) {
//                            //commit Albert Topalu 18.04.19 14:44
////                    if ($fe_route_url['use_card_l'] === 0 && $fe_route_url['fe_url'] != NULL) {
//                            //END commit Albert Topalu 18.04.19 14:44
//
//                            //Edit Albert Topalu 18.04.19 14:44  $fe_route_url['use_card_l'] === ->  $fe_route_url['use_card_l'] ==
//                            if ($fe_route_url['use_card_l'] == 0 && $fe_route_url['fe_url'] != NULL) {
//                                $link = '/' . $fe_route_url['fe_url']['fe_url_code'];
//                            }
//                            //END Edit Albert Topalu 18.04.19 14:44
//                        }
//                    }
                    $item = Arr::add($item, "link", $link);
                    break;
                case($test == 'separator'):
                    $item = Arr::add($item, "separator", '10');
                    break;
                case($test == 'group_l'):
                    if ($menuItem['group_l'] == 0) {
                        $item = Arr::add($item, 'group_l', '0');
                    } else {
                        $item = Arr::add($item, 'group_l', '1');
                    }
                    break;
                case($test == 'line_n'):
                    $item = Arr::add($item, 'line_n', (string) $menuItem['line_n']);
                    break;
            }
        }

        //+Устанавливаем значение title
        $title = $menuItem['menu_item_name'];
        $item = Arr::add($item, 'title', $title);
        //-Устанавливаем значение title

        //+Устанавливаем значение children
        $children = [];
        $kids = collect(Arr::where(self::$menuItemTable, function ($value, $key) use ($menuItem) {
            return $value['menu_item_parent_id'] == $menuItem['id'];
        }))->sortBy('line_n')->toArray();

        foreach ($kids as $kid) {
            $kidAccess = NULL;
            if (self::$check_access) {
                $kidAccess = self::checkMenuItemAccess($kid, self::$accessRolesId, false);
            }
            else {
                $kidAccess = true;
            }

            if ($kidAccess === true || $kidAccess === NULL) {
                $params['menuItem'] = $kid;
                $params['depth'] = $depth;
                array_push($children, $this->buildMenuItem($params));
            }
        }

        if (!empty($children)) {
            $item = Arr::add($item, "children", $children);
        }
        //-Устанавливаем значение children

        return $item;
    }

    private function checkMenuItemAccess($menuItem, $accessRoles, $return_as_list = true){
        $menu_item_view_l = false;
        $parent = $menuItem['menu_item_parent_id'] == null ? null : self::$menuItemTable[$menuItem['menu_item_parent_id']];
        foreach ($accessRoles as $access_role_key => $access_role_value) {

            if(isset($menuItem['menu_item_access_role'][$access_role_value['id']])) {
                $role = $menuItem['menu_item_access_role'][$access_role_value['id']];

            }
            else {
                $role = [
                    'menu_item_id' => $menuItem['id'],
                    'access_role_id' => $access_role_value['id'],
                    'access_role_name' => $access_role_value['access_role_name'],
                    'menu_item_view_l' => $parent == null ? false : null
                ];
            }

            if ($parent != null){
                if (isset($parent['menu_item_access_role'][$access_role_value['id']]))
                    $parent_view_l = $parent['menu_item_access_role'][$access_role_value['id']]['menu_item_view_l'];
                else
                    $parent_view_l = self::checkMenuItemAccess($parent, [$access_role_value], false);

                if ($parent_view_l === false or $role['menu_item_view_l'] === false) {
                    $role['menu_item_view_l'] = false;
                } else {
                    $role['menu_item_view_l'] = true;
                }
            }

            $menuItem['menu_item_access_role'][$access_role_value['id']] = $role;
            if($menu_item_view_l === false)
                $menu_item_view_l = $role['menu_item_view_l'];
        }

        return $menu_item_view_l;
    }

    private function convertMenuToList($menu, $separator = '  ')
    {
        $list_menu = [];
        $items = $menu;

        foreach ($items as $key => $item){
            $cur_item = [];
            foreach ($item as $field_name => $field_value) {
                if ($field_name == 'title')
                    $cur_item = Arr::add($cur_item, $field_name, $separator . self::$marker . $field_value);
                else if ($field_name = 'children')
                    $cur_item = Arr::add($cur_item, $field_name, $field_value);
            }
            array_push($list_menu, $cur_item);
            if (isset($item['children'])){
                $children_list = $this->convertMenuToList($item['children'], $separator . '  ');
                $list_menu = array_merge($list_menu, $children_list);
            }
        }

        return $list_menu;
    }

}