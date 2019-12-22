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
        $consumer_interfaces = [$this->consumer->getUserInterfaces()];

        return $consumer_interfaces;
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
