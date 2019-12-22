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

        $this->texts = (new \App\Http\Controllers\Api\TabTranslation\TranslationCaptionsController())->translations();

        if ($request->object == 'mainmenu' && $request->module == 'main') {
            $params = [
                "menutype" => $request->menutype,
                "check_access" => true,
                "convert_to_list" => false,
                "interface_id" => $request->interface_id ?? null,
            ];

            $menu = (new MenuManager())->buildMenu($params);

            return response()->json($menu, (empty($menu)) ? 403 : 200);

        } elseif ($request->object == 'footer' && $request->module == 'main') {
            $footer = $this->buildFooter();
            return response()->json($footer);
        } elseif ($request->object == 'profilemenu' && $request->module == 'main') {
            $userProfileMenu = $this->buildUserProfileMenu();
            return response()->json($userProfileMenu);
        }
        elseif ($request->object == 'buildBreadcrumbs' && $request->module == 'main') {
            $breadcrumbs = $this->buildBreadcrumbs();
            return response()->json($breadcrumbs);
        }
        elseif ($request->object == 'buildRoutes' && $request->module == 'main') {
            $buildRoutes = $this->buildRoutes();
            return response()->json($buildRoutes);
        }
        elseif ($request->object == 'buildNameBreacrumbs' && $request->module == 'main') {
            $name = $this->buildNameBreacrumbs($request);
            $headers = ['Content-Type' => 'application/json; charset=utf-8'];
            return response()->json($name, 200, $headers, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } elseif ($request->object == 'buildError' && $request->module == 'main') {
            $errors = $this->buildError();
            return response()->json($errors);
        }
        elseif ($request->object == 'translateList' && $request->module == 'main') {
            $listTranslation = $this->translateList();
            return response()->json($listTranslation);
        }
    }

    public function buildUserProfileMenu()
    {

        $userProfileMenu = array();

        $captionName = ['ClientCabinet', 'FeedbackPhone' ,'Notifications' ];
        $getArrayCaptions = $this->getTranslateByKeys($captionName);

        $consumer_name = $this->consumer->getDisplayName();
        $consumer_interfaces = $this->consumer->getUserInterfaces();

        if (request()->interface_id != "undefined") {
            $home_url = array_first(Arr::where($consumer_interfaces, function ($item) {
                return $item['id'] == request()->interface_id;
            }))['home_url'];
        }
        else {
            $home_url = $consumer_interfaces[0]['home_url'];
        }

        $userProfileMenu = [
            'actions' => [
                [
                    'title' => $this->texts->where('caption_name', "LogOut")->first()->caption_translation,
                    'link' => '/api/logout',
                    'img' => '',
                    'type' => 'logout'
                ],
            ],

            'user_interfaces' => $consumer_interfaces,
            'user' => [
                'username' => $consumer_name,
                "first_name"   => $this->consumer->first_name,
                "middle_name"  => $this->consumer->middle_name,
                "last_name"    => $this->consumer->last_name,
            ],

            'translations' => [
                'Notifications' => $getArrayCaptions['Notifications']['translation_captions']['caption_translation'],
                'ClientCabinet' =>$getArrayCaptions['ClientCabinet']['translation_captions']['caption_translation'],
                'FeedbackPhone' =>$getArrayCaptions['FeedbackPhone']['translation_captions']['caption_translation'],
            ],
        ];

        return $userProfileMenu;

    }

    public function buildRoutes()
    {
        $routes = [
            ["path" => "/404", "component" => "Error", "meta" => ['error' => '404']],
            ["path" => "/403", "component" => "Error", "meta" => ['error' => '403']],
            ["path" => "/500", "component" => "Error", "meta" => ['error' => '500']],
            ["path" => "/", "component" => "Home", "meta" => []],
            ["path" => "*/new", "component" => "Card", "meta" => []],
            ["path" => "/profile", "component" => "Profile", "meta" => []],
            ["path" => "/profileTest", "component" => "Profile", "meta" => []],
            ["path" => "/textPage", "component" => "TextPage", "meta" => []],
            ["path" => "/externalReportsByCompanies", "component" => "List", "meta" => []],
            ["path" => "/externalReportsByCompanies/create", "component" => "Report", "meta" => []],
            ["path" => "/documents", "component" => "Document", "meta" => []],
            ["path" => "/documents2", "component" => "Document", "meta" => []],
            ["path" => "/contractors", "component" => "List", "meta" => ["route" => "/admin/contractor/list", "id_field" => "id"]],
            ["path" => "/contractors/:id", "component" => "Card", "meta" => ["route" => "/admin/contractor/card", "id_field" => "id", "model" => "Contractor", "column" => "contractor_short_name"]],
            ["path" => "/contractors/:id/contactInfo", "component" => "List", "meta" => ["route" => "/admin/contactInfoList", "id_field" => "id"]],
            ["path" => "/contractors/:id/contactInfo/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/contactInfoCard", "id_field" => "cont_id", "model" => "InfoType", "column" => "info_type_name"]],
            ["path" => "/contractors/:id/cryptoExchangeAccounts", "component" => "List", "meta" => ["route" => "/admin/contractor/cryptoExchangeAccounts/list", "id_field" => "id",]],
            ["path" => "/contractors/:id/cryptoExchangeAccounts/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/contractor/cryptoExchangeAccounts/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/contractors/:id/cryptoPlatformAccounts", "component" => "List", "meta" => ["route" => "/admin/contractor/cryptoPlatformAccounts/list", "id_field" => "id",]],
            ["path" => "/contractors/:id/cryptoPlatformAccounts/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/contractor/cryptoPlatformAccounts/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/contractors/:id/bankAccounts", "component" => "List", "meta" => ["route" => "/admin/contractor/bankAccounts/list", "id_field" => "id",]],
            ["path" => "/contractors/:id/bankAccounts/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/contractor/bankAccounts/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/contractors/:id/cryptoPlatformWallets", "component" => "List", "meta" => ["route" => "/admin/contractor/cryptoPlatformWallets/list", "id_field" => "id",]],
            ["path" => "/contractors/:id/cryptoPlatformWallets/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/contractor/cryptoPlatformWallets/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/contractors/:id/cryptoExchangeWallets", "component" => "List", "meta" => ["route" => "/admin/contractor/cryptoExchangeWallets/list", "id_field" => "id",]],
            ["path" => "/contractors/:id/cryptoExchangeWallets/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/contractor/cryptoExchangeWallets/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/companies", "component" => "List", "meta" => ["route" => "/admin/company/list", "id_field" => "id"]],
            ["path" => "/companies/:id", "component" => "Card", "meta" => ["route" => "/admin/company/card", "id_field" => "id", "model" => "Company", "column" => "company_short_name"]],
            ["path" => "/companies/:id/contactInfo", "component" => "List", "meta" => ["route" => "/admin/company/ContactInfoList", "id_field" => "id",]],
            ["path" => "/companies/:id/contactInfo/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/company/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/companies/:id/cryptoExchangeAccounts", "component" => "List", "meta" => ["route" => "/admin/company/cryptoExchangeAccounts/list", "id_field" => "id",]],
            ["path" => "/companies/:id/cryptoExchangeAccounts/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/company/cryptoExchangeAccounts/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/companies/:id/cryptoPlatformAccounts", "component" => "List", "meta" => ["route" => "/admin/company/cryptoPlatformAccounts/list", "id_field" => "id",]],
            ["path" => "/companies/:id/cryptoPlatformAccounts/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/company/cryptoPlatformAccounts/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/companies/:id/bankAccounts", "component" => "List", "meta" => ["route" => "/admin/company/bankAccounts/list", "id_field" => "id",]],
            ["path" => "/companies/:id/bankAccounts/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/company/bankAccounts/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/companies/:id/cryptoPlatformWallets", "component" => "List", "meta" => ["route" => "/admin/company/cryptoPlatformWallets/list", "id_field" => "id",]],
            ["path" => "/companies/:id/cryptoPlatformWallets/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/company/cryptoPlatformWallets/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/companies/:id/cryptoExchangeWallets", "component" => "List", "meta" => ["route" => "/admin/company/cryptoExchangeWallets/list", "id_field" => "id",]],
            ["path" => "/companies/:id/cryptoExchangeWallets/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/company/cryptoExchangeWallets/card", "id_field" => "cont_id", "model" => "contactInfo", "column" => "info_type_name"]],
            ["path" => "/dbAreas", "component" => "List", "meta" => ["route" => "/admin/db/area/list", "id_field" => "id"]],
            ["path" => "/dbAreas/:id", "component" => "Card", "meta" => ["route" => "/admin/db/area/card", "id_field" => "id", "model" => "DbArea", "column" => "db_area_code"]],
            ["path" => "/countries", "component" => "List", "meta" => ["route" => "/admin/country/list", "id_field" => "id"]],
            ["path" => "/countries/:id", "component" => "Card", "meta" => ["route" => "/admin/country/card", "id_field" => "id", "model" => "Country", "column" => "country_name"]],
            ["path" => "/countries/:id/regions", "component" => "List", "meta" => ["route" => "/admin/countries/regionsList", "id_field" => "id",]],
            ["path" => "/countries/:id/regions/:cont_id", "component" => "Card", "meta" => ["route" => "/admin/region/card", "id_field" => "cont_id", "model" => "Region", "column" => "region_name"]],
            ["path" => "/consumerAccounts", "component" => "List", "meta" => ["route" => "/admin/consumer/accounts/list", "id_field" => "id"]],
            ["path" => "/consumerAccounts/:id", "component" => "Card", "meta" => ["route" => "/admin/consumer/accounts/card", "id_field" => "id", "model" => "ConsumerAccount", "column" => "consumer_account_name"]],
            ["path" => "/fileTypes", "component" => "List", "meta" => ["route" => "/admin/fileTypes/list", "id_field" => "id"]],
            ["path" => "/fileTypes/:id", "component" => "Card", "meta" => ["route" => "/admin/fileTypes/card", "id_field" => "id", "model" => "FileType", "column" => "file_type_name"]],
            ["path" => "/attachedKind", "component" => "List", "meta" => ["route" => "/admin/attachedKind/list", "id_field" => "id"]],
            ["path" => "/attachedKind/:id", "component" => "Card", "meta" => ["route" => "/admin/attachedKind/card", "id_field" => "id", "model" => "AttachedDocumentKind", "column" => "att_doc_kind_name"]],
            ["path" => "/attachedType", "component" => "List", "meta" => ["route" => "/admin/attachedType/list", "id_field" => "id"]],
            ["path" => "/attachedType/:id", "component" => "Card", "meta" => ["route" => "/admin/attachedType/card", "id_field" => "id", "model" => "AttachedDocumentType", "column" => "att_doc_type_name"]],
            ["path" => "/languages", "component" => "List", "meta" => ["route" => "/admin/languages/list", "id_field" => "id"]],
            ["path" => "/languages/:id", "component" => "Card", "meta" => ["route" => "/admin/language/card", "id_field" => "id", "model" => "Language", "column" => "language_name"]],
            ["path" => "/serversDb", "component" => "List", "meta" => ["route" => "/admin/serverdbs/list", "id_field" => "id"]],
            ["path" => "/serversDb/:id", "component" => "Card", "meta" => ["route" => "/admin/serverdbs/card", "id_field" => "id", "model" => "ServerDb", "column" => "server_name"]],
            ["path" => "/banks", "component" => "List", "meta" => ["route" => "/admin/banks/list", "id_field" => "id"]],
            ["path" => "/banks/:id", "component" => "Card", "meta" => ["route" => "/admin/banks/card", "id_field" => "id", "model" => "Bank", "column" => "bank_name"]],
            ["path" => "/bankAccountTypes", "component" => "List", "meta" => ["route" => "/admin/bankAccountTypes/list", "id_field" => "id"]],
            ["path" => "/bankAccountTypes/:id", "component" => "Card", "meta" => ["route" => "/admin/bankAccountTypes/card", "id_field" => "id", "model" => "BankAccountType", "column" => "bank_account_type_name"]],
            ["path" => "/cryptoTokens", "component" => "List", "meta" => ["route" => "/admin/cryptoTokens/list", "id_field" => "id"]],
            ["path" => "/cryptoTokens/:id", "component" => "Card", "meta" => ["route" => "/admin/cryptoTokens/card", "id_field" => "id", "model" => "CryptoToken", "column" => "c_token_code"]],
            ["path" => "/images", "component" => "List", "meta" => ["route" => "/admin/images/list", "id_field" => "id"]],
            ["path" => "/images/:id", "component" => "Card", "meta" => ["route" => "/admin/images/card", "id_field" => "id", "model" => "Image", "column" => "image_name"]],
            ["path" => "/imageCategories", "component" => "List", "meta" => ["route" => "/admin/imageCategories/list", "id_field" => "id"]],
            ["path" => "/imageCategories/:id", "component" => "Card", "meta" => ["route" => "/admin/imageCategories/card", "id_field" => "id", "model" => "ImageCategory", "column" => "image_category_name"]],
            ["path" => "/currencies", "component" => "List", "meta" => ["route" => "/admin/currencies/list", "id_field" => "id"]],
            ["path" => "/currencies/:id", "component" => "Card", "meta" => ["route" => "/admin/currencies/card", "id_field" => "id", "model" => "Currency", "column" => "currency_name"]],
            ["path" => "/cryptoExchanges", "component" => "List", "meta" => ["route" => "/admin/cryptoExchanges/list", "id_field" => "id"]],
            ["path" => "/cryptoExchanges/:id", "component" => "Card", "meta" => ["route" => "/admin/cryptoExchanges/card", "id_field" => "id", "model" => "CryptoExchange", "column" => "c_exchange_name"]],
            ["path" => "/cryptoPlatforms", "component" => "List", "meta" => ["route" => "/admin/cryptoPlatforms/list", "id_field" => "id"]],
            ["path" => "/cryptoPlatforms/:id", "component" => "Card", "meta" => ["route" => "/admin/cryptoPlatforms/card", "id_field" => "id", "model" => "CryptoPlatform", "column" => "c_platform_name"]],
            ["path" => "/captions", "component" => "List", "meta" => ["route" => "/admin/captions/list", "id_field" => "id"]],
            ["path" => "/captions/:id", "component" => "Card", "meta" => ["route" => "/admin/captions/card", "id_field" => "id", "model" => "Caption", "column" => "caption_name"]],
            ["path" => "/translationCaptions", "component" => "List", "meta" => ["route" => "/admin/translationCaptions/list", "id_field" => "id"]],
            ["path" => "/translationCaptions/:id", "component" => "Card", "meta" => ["route" => "/admin/translationCaptions/card", "id_field" => "id", "model" => "TranslationCaption", "column" => "caption_translation"]],
            ["path" => "/dbs", "component" => "List", "meta" => ["route" => "/admin/db/list", "id_field" => "id"]],
            ["path" => "/dbs/:id", "component" => "Card", "meta" => ["route" => "/admin/db/card", "id_field" => "id", "model" => "DBase", "column" => "db_name"]],
            ["path" => "/regions", "component" => "List", "meta" => ["route" => "/admin/region/list", "id_field" => "id"]],
            ["path" => "/regions/:id", "component" => "Card", "meta" => ["route" => "/admin/region/card", "id_field" => "id", "model" => "Region", "column" => "region_name"]],
            ["path" => "/attachedFile", "component" => "List", "meta" => ["route" => "/admin/attachedFile", "id_field" => "id"]],
            ["path" => "/dbTypes", "component" => "List", "meta" => ["route" => "/admin/dbtypes/list", "id_field" => "id"]],
            ["path" => "/dbTypes/:id", "component" => "Card", "meta" => ["route" => "/admin/dbtypes/card", "id_field" => "id", "model" => "DbType", "column" => "db_type_name"]],
            ["path" => "/pages", "component" => "List", "meta" => ["route" => "/admin/dbtypes/list", "id_field" => "id"]],
            ["path" => "/pages/:id", "component" => "Card", "meta" => ["route" => "/admin/dbtypes/card", "id_field" => "id", "model" => "contractors", "column" => "contractor_short_name"]],
            ["path" => "/requests/:id", "component" => "Steps", "meta" => ["model" => ''], "children" => [
                ["path" => "step1", "component" => "Card", "meta" => ["route" => "/admin/dbtypes/card", "id_field" => "id"]],
                ["path" => "step2", "component" => "List", "meta" => ["route" => "/admin/db/list", "id_field" => "id"]],
                ["path" => "step3", "component" => "List", "meta" => ["route" => "/admin/translationCaptions/list", "id_field" => "id"]],
                ["path" => "step4", "component" => "Card", "meta" => ["route" => "/admin/dbtypes/card", "id_field" => "id"]],
                ["path" => "step5", "component" => "List", "meta" => ["route" => "/admin/dbtypes/list", "id_field" => "id"]],
                ["path" => "step6", "component" => "List", "meta" => ["route" => "/admin/dbtypes/list", "id_field" => "id"]],
            ]]

        ];

        return $routes;

    }


    public function buildManagerMainMenu()
    {
        $managerMenu = [
            "items" => [
                [

                    'title' => $this->texts->where('caption_name', "UserProfile")->first()->caption_translation,
                    'img' => '/img/userData.svg',
                    'link' => '',
                    'separator' => '10',
                    'depth' => 1,
                    'children' => [
                        [
                            'title' => $this->texts->where('caption_name', "UserData")->first()->caption_translation,
                            'link' => '/profile',
                            'img' => '',
                            'separator' => '10',
                            'depth' => 2
                        ],
                    ]
                ],
                [
                    'title' => $this->texts->where('caption_name', "Administration")->first()->caption_translation,
                    'img' => '/img/administration.svg',
                    'link' => '',
                    'separator' => '10',
                    'depth' => 1,
                    'children' => [

                        ['title' => $this->texts->where('caption_name', "Contractors")->first()->caption_translation, 'link' => '/contractors', 'img' => '', 'separator' => '10'],
                        [
                            'title' => $this->texts->where('caption_name', "ExternalDatabaseSettings")->first()->caption_translation,
                            'link' => '',
                            'img' => '',
                            'children' => [
                                ['title' => $this->texts->where('caption_name', "DatabaseServers")->first()->caption_translation, 'link' => '/serversDb', 'img' => '', 'depth' => '3'],
                                ['title' => $this->texts->where('caption_name', "Databases")->first()->caption_translation, 'link' => '/dbs', 'img' => '', 'depth' => '3'],
                                ['title' => $this->texts->where('caption_name', "DbTypes")->first()->caption_translation, 'link' => '/dbTypes', 'img' => '', 'depth' => '3'],
                                ['title' => $this->texts->where('caption_name', "DatabaseAreas")->first()->caption_translation, 'link' => '/dbAreas', 'img' => '', 'depth' => '3'],
                            ]
                        ],
                    ]
                ],
            ],
            "menu_parameters" => [
                "first_level_icons" => true,
                "any_level_icons" => true,
            ]
        ];
        return $managerMenu;
    }


    public function buildAdminMainMenu()
    {
        $adminMenu = array();
        $adminMenu[] = array(

            'title' => $this->texts->where('caption_name', "UserProfile")->first()->caption_translation,
            'img' => '/img/userData.svg',
            'link' => '',

            'children' => [
                [
                    'title' => $this->texts->where('caption_name', "UserData")->first()->caption_translation,
                    'link' => '/profile',
                    'img' => ''
                ],
            ]


        );
        $adminMenu[] = array(

            'title' => $this->texts->where('caption_name', "Administration")->first()->caption_translation,
            'img' => '/img/administration.svg',
            'link' => '',
            'children' => [

                ['title' => $this->texts->where('caption_name', "Companies")->first()->caption_translation, 'link' => '/companies', 'img' => ''],
                ['title' => $this->texts->where('caption_name', "Contractors")->first()->caption_translation, 'link' => '/contractors', 'img' => ''],
                [
                    'title' => $this->texts->where('caption_name', "ExternalDatabaseSettings")->first()->caption_translation,
                    'link' => '',
                    'img' => '',
                    'children' => [
                        ['title' => $this->texts->where('caption_name', "DatabaseServers")->first()->caption_translation, 'link' => '/serversDb', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "Databases")->first()->caption_translation, 'link' => '/dbs', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "DatabaseAreas")->first()->caption_translation, 'link' => '/dbAreas', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "DbTypes")->first()->caption_translation, 'link' => '/dbTypes', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "ConsumerAccounts")->first()->caption_translation, 'link' => '/consumerAccounts', 'img' => ''],

                    ]
                ],
                ['title' => $this->texts->where('caption_name', "CountriesAndRegions")->first()->caption_translation, 'link' => '', 'img' => '',

                    'children' => [
                        ['title' => $this->texts->where('caption_name', "Countries")->first()->caption_translation, 'link' => '/countries', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "Regions")->first()->caption_translation, 'link' => '/regions', 'img' => ''],
                    ]

                ],
                [
                    'title' => $this->texts->where('caption_name', "LanguageSettings")->first()->caption_translation,
                    'img' => '',
                    'link' => '',
                    'children' => [
                        ['title' => $this->texts->where('caption_name', "Languages")->first()->caption_translation, 'link' => '/languages', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "CaptionsCodes")->first()->caption_translation, 'link' => '/captionsСodes', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "CaptionTranslations")->first()->caption_translation, 'link' => '/translationCaptions', 'img' => ''],
                    ]
                ],
                ['title' => $this->texts->where('caption_name', "contactInfo")->first()->caption_translation, 'link' => '', 'img' => '',

                    'children' => [
                        ['title' => $this->texts->where('caption_name', "ContactInfoKinds")->first()->caption_translation, 'link' => '/infoKinds', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "ContactInfoTypes")->first()->caption_translation, 'link' => '/infoTypes', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "CompaniesContactInfo")->first()->caption_translation, 'link' => '/companiesContactInfo', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "ContractorsContactInfo")->first()->caption_translation, 'link' => '/contractorsContactInfo', 'img' => ''],
                    ]

                ],
                ['title' => $this->texts->where('caption_name', "Accesses")->first()->caption_translation, 'link' => '', 'img' => '',
                    'children' => [
                        ['title' => $this->texts->where('caption_name', "AccessTypes")->first()->caption_translation, 'link' => '/accessTypes', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "ConsumersAccesses")->first()->caption_translation, 'link' => '/consumersAccesses', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "AccessTypeRows")->first()->caption_translation, 'link' => '/accessTypeRows', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "AccessEntities")->first()->caption_translation, 'link' => '/accessEntities', 'img' => ''],

                    ]


                ],
                [
                    'title' => $this->texts->where('caption_name', "DataChanges")->first()->caption_translation,
                    'link' => '',
                    'img' => '',
                    'children' => [
                        ['title' => $this->texts->where('caption_name', "DataChangeReasons")->first()->caption_translation, 'link' => '/dataChangeReasons', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "CompaniesChanges")->first()->caption_translation, 'link' => '/companiesChanges', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "CompaniesContactInfoChanges")->first()->caption_translation, 'link' => '/companiesContactInfoChanges', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "ContractorsChanges")->first()->caption_translation, 'link' => '/ContractorsChanges', 'img' => ''],
                        ['title' => $this->texts->where('caption_name', "ContractorsContactInfoChanges")->first()->caption_translation, 'link' => '/contractorsContactInfoChanges', 'img' => ''],

                    ]
                ],


            ]

        );
        $adminMenu[] = array(


            'title' => $this->texts->where('caption_name', "ExternalReports")->first()->caption_translation,
            'link' => '',
            'img' => '/img/report.svg',
            'children' => [


                ['title' => $this->texts->where('caption_name', "Companies")->first()->caption_translation, 'link' => '/externalReportsByCompanies', 'img' => ''],
                ['title' => $this->texts->where('caption_name', "Contractors")->first()->caption_translation, 'link' => '/externalReportsByContractors', 'img' => ''],
            ]


        );
        return $adminMenu;
    }

    public function buildUserMainMenu()
    {
        $userMenu = array();
        $userMenu[] = array(

            'title' => $this->texts->where('caption_name', "UserProfile")->first()->caption_translation,
            'img' => '/img/userData.svg',
            'link' => '',

            'children' => [
                [
                    'title' => $this->texts->where('caption_name', "UserData")->first()->caption_translation,
                    'link' => '/profile',
                    'img' => ''
                ],
            ]

        );
        $userMenu[] = array(


            'title' => $this->texts->where('caption_name', "ExternalReports")->first()->caption_translation,
            'link' => '',
            'img' => '/img/report.svg',
            'children' => [


                ['title' => $this->texts->where('caption_name', "Companies")->first()->caption_translation, 'link' => '/externalReportsByCompanies', 'img' => ''],

            ]


        );
        return $userMenu;

    }

    public function buildFooter()
    {

        //
        $footer = [
            'menu' => [
                [
                    'title' => 'Blog',
                    'link' => '/blog',
                    'img' => '',
                ],
                [
                    'title' => 'Support',
                    'link' => '/support',
                    'img' => '',
                ],
                [
                    'title' => 'TermsAndConditions',
                    'link' => '/terms',
                    'img' => '',
                ],
                [
                    'title' => 'Privacy',
                    'link' => '/privacy',
                    'img' => '',
                ]
            ],
            'copyright' => [
                'caption' => 'DIGITAL AGENCY 2019 | LardanSoft'
            ]
        ];
        return $footer;
    }

    public function buildBreadcrumbs()
    {
        $breadcrumbs[] = [
            '/' => $this->texts->where('caption_name', "Dashboard")->first()->caption_translation,
            '/profile' => $this->texts->where('caption_name', "personalInfo")->first()->caption_translation,
            '/contractors/:id' => $this->texts->where('caption_name', "NameContractor")->first()->caption_translation,
            '/contractors/:id/contactInfo' => $this->texts->where('caption_name', "contactInfo")->first()->caption_translation,
            '/contractors_new' => $this->texts->where('caption_name', "Contractors")->first()->caption_translation,
            '/contractors_new/:id' => $this->texts->where('caption_name', "NameContractor")->first()->caption_translation,
            '/contractors_new/:id/contactInfo' => $this->texts->where('caption_name', "contactInfo")->first()->caption_translation,
            '/companies/:id' => $this->texts->where('caption_name', "NameCompany")->first()->caption_translation,
            '/companies/:id/contactInfo' => $this->texts->where('caption_name', "contactInfo")->first()->caption_translation,
            '/companies/:id/contactInfo/:cont_id' => $this->texts->where('caption_name', "contactInfo")->first()->caption_translation,
            '/contractors/:id/contactInfo/:cont_id' => $this->texts->where('caption_name', "contactInfo")->first()->caption_translation,
            '/externalReportsByCompanies' => $this->texts->where('caption_name', "ExternalReports")->first()->caption_translation,
            '/externalReportsByCompanies/create' => $this->texts->where('caption_name', "CreateReport")->first()->caption_translation,
            '/contractorsContactInfoChanges' => $this->texts->where('caption_name', "ContractorsContactInfoChanges")->first()->caption_translation,
            '/ContractorsChanges' => $this->texts->where('caption_name', "ContractorsChanges")->first()->caption_translation,
            '/companiesContactInfoChanges' => $this->texts->where('caption_name', "CompaniesContactInfoChanges")->first()->caption_translation,
            '/companiesChanges' => $this->texts->where('caption_name', "CompaniesChanges")->first()->caption_translation,
            '/dataChangeReasons' => $this->texts->where('caption_name', "DataChangeReasons")->first()->caption_translation,
            '/accessEntities' => $this->texts->where('caption_name', "AccessEntities")->first()->caption_translation,
            '/accessTypeRows' => $this->texts->where('caption_name', "AccessTypeRows")->first()->caption_translation,
            '/consumersAccesses' => $this->texts->where('caption_name', "ConsumersAccesses")->first()->caption_translation,
            '/accessTypes' => $this->texts->where('caption_name', "AccessTypes")->first()->caption_translation,
            '/contractorsContactInfo' => $this->texts->where('caption_name', "ContractorsContactInfo")->first()->caption_translation,
            '/companiesContactInfo' => $this->texts->where('caption_name', "CompaniesContactInfo")->first()->caption_translation,
            '/infoTypes' => $this->texts->where('caption_name', "ContactInfoTypes")->first()->caption_translation,
            '/infoKinds' => $this->texts->where('caption_name', "ContactInfoKinds")->first()->caption_translation,
            '/translationCaptions' => $this->texts->where('caption_name', "CaptionTranslations")->first()->caption_translation, //todo поменять на правильный caption
            '/dbTypes' => $this->texts->where('caption_name', "DbTypes")->first()->caption_translation,                                                                                     //todo поменять на правильный caption
            '/regions' => $this->texts->where('caption_name', "Regions")->first()->caption_translation,
            '/countries' => $this->texts->where('caption_name', "Countries")->first()->caption_translation,
            '/dbAreas' => $this->texts->where('caption_name', "DatabaseAreas")->first()->caption_translation,
            '/dbs' => $this->texts->where('caption_name', "Databases")->first()->caption_translation,
            '/serversDb' => $this->texts->where('caption_name', "DatabaseServers")->first()->caption_translation,
            '/contractors' => $this->texts->where('caption_name', "Contractors")->first()->caption_translation,
            '/companies' => $this->texts->where('caption_name', "Companies")->first()->caption_translation,
            '/languages' => $this->texts->where('caption_name', "Languages")->first()->caption_translation,
            '/captions' => $this->texts->where('caption_name', "CaptionList")->first()->caption_translation,
            '/companies_new' => $this->texts->where('caption_name', "Companies")->first()->caption_translation,
            '/companies_new/:id/contactInfo' => $this->texts->where('caption_name', "contactInfo")->first()->caption_translation,
            '/countries/:id/regions' => $this->texts->where('caption_name', "Regions")->first()->caption_translation,
            '/attachedType' => $this->texts->where('caption_name', "DocumentType")->first()->caption_translation,
            '/attachedKind' => $this->texts->where('caption_name', "DocumentKind")->first()->caption_translation,
            'currentLng' => Lang::locale(),
            '/banks' => $this->texts->where('caption_name', "Banks")->first()->caption_translation,
            '/currencies' => $this->texts->where('caption_name', "Currencies")->first()->caption_translation,
            '/cryptoExchanges' => $this->texts->where('caption_name', "CryptoExchanges")->first()->caption_translation,
            '/cryptoPlatforms' => $this->texts->where('caption_name', "CryptoPlatforms")->first()->caption_translation,
            '/cryptoTokens' => $this->texts->where('caption_name', "CryptoTokens")->first()->caption_translation,
            '/bankAccountTypes' => $this->texts->where('caption_name', "BankAccountTypes")->first()->caption_translation,
            '/companies/:id/bankAccounts' => $this->texts->where('caption_name', "BankAccount")->first()->caption_translation,
            '/contractors/:id/bankAccounts' => $this->texts->where('caption_name', "BankAccount")->first()->caption_translation,
            '/imageCategories' => $this->texts->where('caption_name', "ImageCategories")->first()->caption_translation,
            '/companies/:id/cryptoExchangeAccounts' => $this->texts->where('caption_name', "CryptoExchangeAccounts")->first()->caption_translation,
            '/contractors/:id/cryptoExchangeAccounts' => $this->texts->where('caption_name', "CryptoExchangeAccounts")->first()->caption_translation,
            '/companies/:id/cryptoPlatformAccounts' => $this->texts->where('caption_name', "CryptoPlatformAccounts")->first()->caption_translation,
            '/contractors/:id/cryptoPlatformAccounts' => $this->texts->where('caption_name', "CryptoPlatformAccounts")->first()->caption_translation,
            '/images' => $this->texts->where('caption_name', "Images")->first()->caption_translation,
            '/fileTypes' => $this->texts->where('caption_name', "Format")->first()->caption_translation,
            '/contractors/:id/cryptoPlatformAccounts/:id/cryptoPlatformWallets' => $this->texts->where('caption_name', "CryptoWallets")->first()->caption_translation,
        ];
        return $breadcrumbs;
    }

    public function translateList()
    {
        $captionName = [
            'Showing', 'of', 'onThePage', 'Actions',
            'Search', 'CreateReport', 'ReportsList', 'All', 'ThereAreNoRecordsMatchingRequest', 'Filter',
            'Payment', 'Planned', 'Paid', 'Overdue','SortAZ','SortZA','FilterCondition','FilterValue','Empty','CellEmpty','DataCell',
            'TextСontains','EnterText','TextNotContain','TextBeginsWith','TextEndsWith','TextExactly','ChooseDate','DateTo','DateAfter',
            'More','MoreOrEqual','InsertNumber','Less','LessOrEqual','Equally','NotEqual','Between','Before','NotBetween','Date','NotSelected'
        ];
        $getArrayCaptions = $this->getTranslateByKeys($captionName);
        $listTranslation = [
            'Showing' => $getArrayCaptions['Showing']['translation_captions']['caption_translation'],
            'of' => $getArrayCaptions['of']['translation_captions']['caption_translation'],
            'onThePage' => $getArrayCaptions['onThePage']['translation_captions']['caption_translation'],
            'Actions' => $getArrayCaptions['Actions']['translation_captions']['caption_translation'],
            'all_select' => $getArrayCaptions['All']['translation_captions']['caption_translation'],
            'Search' => $getArrayCaptions['Search']['translation_captions']['caption_translation'],
            'EmptyFilteredText' => $getArrayCaptions['ThereAreNoRecordsMatchingRequest']['translation_captions']['caption_translation'],
            'enableFilter' => $getArrayCaptions['Filter']['translation_captions']['caption_translation'],
            'Payment' => $getArrayCaptions['Payment']['translation_captions']['caption_translation'],
            'Planned' => $getArrayCaptions['Planned']['translation_captions']['caption_translation'],
            'Paid' => $getArrayCaptions['Paid']['translation_captions']['caption_translation'],
            'Overdue' => $getArrayCaptions['Overdue']['translation_captions']['caption_translation'],
            'SortAZ' => $getArrayCaptions['SortAZ']['translation_captions']['caption_translation'],
            'SortZA' => $getArrayCaptions['SortZA']['translation_captions']['caption_translation'],
            'FilterCondition' => $getArrayCaptions['FilterCondition']['translation_captions']['caption_translation'],
            'FilterValue' => $getArrayCaptions['FilterValue']['translation_captions']['caption_translation'],
            'Empty' => $getArrayCaptions['Empty']['translation_captions']['caption_translation'],
            'CellEmpty' => $getArrayCaptions['CellEmpty']['translation_captions']['caption_translation'],
            'DataCell' => $getArrayCaptions['DataCell']['translation_captions']['caption_translation'],
            'TextСontains' => $getArrayCaptions['TextСontains']['translation_captions']['caption_translation'],
            'EnterText' => $getArrayCaptions['EnterText']['translation_captions']['caption_translation'],
            'TextNotContain' => $getArrayCaptions['TextNotContain']['translation_captions']['caption_translation'],
            'TextBeginsWith' => $getArrayCaptions['TextBeginsWith']['translation_captions']['caption_translation'],
            'TextEndsWith' => $getArrayCaptions['TextEndsWith']['translation_captions']['caption_translation'],
            'TextExactly' => $getArrayCaptions['TextExactly']['translation_captions']['caption_translation'],
            'ChooseDate' => $getArrayCaptions['ChooseDate']['translation_captions']['caption_translation'],
            'DateTo' => $getArrayCaptions['DateTo']['translation_captions']['caption_translation'],
            'DateAfter' => $getArrayCaptions['DateAfter']['translation_captions']['caption_translation'],
            'More' => $getArrayCaptions['More']['translation_captions']['caption_translation'],
            'MoreOrEqual' => $getArrayCaptions['MoreOrEqual']['translation_captions']['caption_translation'],
            'InsertNumber' => $getArrayCaptions['InsertNumber']['translation_captions']['caption_translation'],
            'Less' => $getArrayCaptions['Less']['translation_captions']['caption_translation'],
            'LessOrEqual' => $getArrayCaptions['LessOrEqual']['translation_captions']['caption_translation'],
            'Equally' => $getArrayCaptions['Equally']['translation_captions']['caption_translation'],
            'NotEqual' => $getArrayCaptions['NotEqual']['translation_captions']['caption_translation'],
            'Between' => $getArrayCaptions['Between']['translation_captions']['caption_translation'],
            'Before' => $getArrayCaptions['Before']['translation_captions']['caption_translation'],
            'NotBetween' => $getArrayCaptions['NotBetween']['translation_captions']['caption_translation'],
            'Date' => $getArrayCaptions['Date']['translation_captions']['caption_translation'],
            'NotSelected' => $getArrayCaptions['NotSelected']['translation_captions']['caption_translation'],
        ];
        return $listTranslation;
    }

    public function buildNameBreacrumbs(Request $request)
    {
        $model = 'App\Models\\' . $request->component;
        $name = $model::where('id', $request->id)->value($request->column);
        return $name;
    }


    public function buildError()
    {
        $errors = [
            '500' => $this->texts->where('caption_name', "Error500Unexpected")->first()->caption_translation,
            '403' => $this->texts->where('caption_name', "Error403Forbidden")->first()->caption_translation,
            '404' => $this->texts->where('caption_name', "Error404PageNotFound")->first()->caption_translation,
            'PageDoesnExist' => $this->texts->where('caption_name', "ErrorPageDoesnExist")->first()->caption_translation,
            'GoHeadOver' => $this->texts->where('caption_name', "ErrorGoHeadOver")->first()->caption_translation,
            'or' => $this->texts->where('caption_name', "or")->first()->caption_translation,
            'ContactUs' => $this->texts->where('caption_name', "ErrorContactUs")->first()->caption_translation,
        ];
        return $errors;
    }


    public function addTranslations()
    {
    }
}
