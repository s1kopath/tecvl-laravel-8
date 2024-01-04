<?php

use App\Models\{File, RoleUser, PermissionRole};


if (!function_exists('getJsonDataFromFile')) {
    /**
     * Get Data From Json File
     * @param  string $file [description]
     * @return array       [description]
     */
    function getJsonDataFromFile($file = null)
    {
        if (empty($file)) {
            return [];
        }

        $data = json_decode(file_get_contents($file));

        return $data;
    }
}


/**
 * [getUniqueAssocArray description]
 * @param  array  $array [description]
 * @return array        [description]
 */
function getUniqueAssocArray($array = [])
{
    if (!is_array($array) || empty($array)) {
        return array();
    }

    $unique = [];
    foreach ($array as $key => $value) {
        if (!array_key_exists($key, $unique)) {
            $unique[$key] = $value;
        }
    }

    return $unique;
}

/**
 * Create a json file from array
 * @param  string $filename [description]
 * @param  array  $data     [description]
 * @return void          [description]
 */
function createJsonFile($filename = 'file.json', $data = array())
{
    $fp = fopen($filename, 'w');
    fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
    fclose($fp);
}


function translateValidationMessages()
{
    $flag = config('app.locale');
    if (!empty($flag) && file_exists(public_path('../resources/lang/validation/' . $flag . '.js'))) {
        return '<script src="' . asset('resources/lang/validation/' . $flag . '.js') . '"></script>';
    }
}

/**
 * To get user profile picture
 * @param  int $userId [user id]
 * @param  int $thumbnail
 * @return string $image [ user profile picture]
 */
function getUserProfilePicture($userId = null, $thumbnail = 1)
{
    $image = Cache::get(config('cache.prefix') . '-user-' . $thumbnail . '-avatar-' . $userId);
    if (empty($image)) {
        $image = url("public/dist/img/avatar.jpg");
        if (!empty($userId)) {
            $userPic = (new File)->getFiles('USER', $userId);
            if (isset($userPic[0])) {
                $path = $thumbnail ? 'uploads/user/thumbnail/' : 'uploads/user/';
                if (file_exists(public_path($path . $userPic[0]->file_name))) {
                    $image = url('public/' . $path . $userPic[0]->file_name);
                }
            }
        }
        Cache::put(config('cache.prefix') . '-user-' . $thumbnail . '-avatar-' . $userId, $image, 604800);
    }

    return $image;
}

function getImageData($id = null, $type = null, $name = null, $path = null, $isCatchble = null, $allImage = false)
{
    $image = Cache::get(config('cache.prefix') . '-' . strtolower($type) . '-' . $name . '-' . $id);
    if (empty($image)) {
        $image = url("public/dist/img/default-image.png");
        if (!empty($id)) {
            $pic = (new File)->getFiles($type, $id);
            if ($allImage == true) {
                $image = [];
                foreach ($pic as $p) {
                    $image[] = url('public/' . $path . $p->file_name);
                }
            } else {
                if (isset($pic[0])) {
                    if (file_exists(public_path($path . $pic[0]->file_name))) {
                        $image = url('public/' . $path . $pic[0]->file_name);
                    }
                }
            }
        }
        if (!empty($isCatchble)) {
            Cache::put(config('cache.prefix') . '-' . strtolower($type) . '-' . $name . '-' . $id, $image, 604800);
        }
    }

    return $image;
}

function validatePhoneNumber($number = null)
{
    $pattern = "/^[+0-9 () \-]{8,20}$/";
    if (!empty($number) && preg_match($pattern, $number)) {
        return 1;
    }

    return 0;
}

function validateEmail($email = null)
{
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    if (!empty($email) && preg_match($pattern, $email)) {
        return 1;
    }

    return 0;
}

function validateName($name = null)
{
    $pattern = "/^[a-zA-Z-'\s]+[a-zA-Z-'\.?\s]+$/";
    if (!empty($name) && preg_match($pattern, $name)) {
        $result = 1;
    } else {
        $result = 0;
    }

    if ($result) {
        $result = strlen($name) > 0 ? 1 : 0;
    }

    return $result;
}


function getThemeClass($tagName = null)
{
    $cssClass = "";
    if (empty($tagName)) {
        return $cssClass;
    }

    $themePreferences = preference('theme_preference');
    $themePreferences = !empty($themePreferences) ? json_decode($themePreferences, true) : '';

    if (!is_array($themePreferences)) {
        return $cssClass;
    }

    foreach ($themePreferences as $key => $value) {
        if ($value == 'default') {
            $data[$key] = '';
        } else {
            $data[$key] = $value;
        }
    }

    if ($tagName == 'header') {
        $cssClass = (!empty($data['header_background']) ? $data['header_background'] : '') . ' ' . (!empty($data['header-fixed']) ? $data['header-fixed'] : '');
        return $cssClass;
    }

    if ($tagName == 'body') {
        $cssClass = !empty($themePreferences['box-layout']) ? $themePreferences['box-layout'] : '';
        return $cssClass;
    }

    if ($tagName == 'navbar') {
        $cssClass = (!empty($data['theme_mode']) ? $data['theme_mode'] : 'pcoded-navbar' . ' ') .
            (!empty($data['menu_brand_background']) ? $data['menu_brand_background'] : '') . ' ' .
            (!empty($data['menu_background']) ? $data['menu_background'] : '') . ' ' .
            (!empty($data['menu_item_color']) ? $data['menu_item_color'] : '') . ' ' .
            (!empty($data['navbar_image']) ? $data['navbar_image'] : '') . ' ' .
            (!empty($data['menu-icon-colored']) ? $data['menu-icon-colored'] : '') . ' ' .
            (!empty($data['menu-fixed']) ? $data['menu-fixed'] : '') . ' ' .
            (!empty($data['menu_list_icon']) ? $data['menu_list_icon'] : '') . ' ' .
            (!empty($data['menu_dropdown_icon']) ? $data['menu_dropdown_icon'] : '');
        return $cssClass;
    }

    if ($tagName == 'theme-mode') {
        $cssClass = !empty($themePreferences['theme_mode']) ? $themePreferences['theme_mode'] : '';
        return $cssClass;
    }

    return $cssClass;
}





/**
 * Open Translation File
 * @return Response
 */
function openJSONFile($code)
{
    $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
    $jsonString = json_decode($jsonString, true);
    return $jsonString;
}

/**
 * Save JSON File
 * @return Response
 */
function saveJSONFile($code, $data)
{
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
    \Cache::forget('lanObject-' . $code);
}


/**
 * set color of file name and icon
 * @param  string $fileExtension
 * @return string
 */
function setColor($fileExtension)
{
    $color = "#0F9D58";
    if (in_array($fileExtension, array('csv', 'xls', 'xlsx'))) {
        $color = '#00A953';
    } else if ($fileExtension == 'pdf') {
        $color = '#FB4C2F';
    } else if (in_array($fileExtension, array('jpg', 'png', 'jpeg', 'gif'))) {
        $color = '#D93025';
    } else if (in_array($fileExtension, array('doc', 'docx'))) {
        $color = '#4986E7';
    }

    return $color;
}


/**
 * Get the specified option value.
 * If field not found default will return
 *
 * @param  string  $field
 * @param  mixed   $default
 * @return mixed
 */
function preference($field = null, $default = null)
{
    $preference = new App\Models\Preference();

    if (is_null($field)) {
        return $preference->getAll()->pluck('value', 'field')->toArray();
    }

    $value = $default;
    $preferences = $preference->getAll()->pluck('value', 'field')->toArray();
    if (array_key_exists($field, $preferences)) {
        $value = $preferences[$field];
    }

    return $value;
}

/**
 * Get the specified option value.
 * If field not found default will return
 *
 * @param  string  $field
 * @param  mixed   $default
 * @return mixed
 */
if (!function_exists('option')) {

    function option($field = null, $default = null)
    {
        $themeOptions = new Modules\CMS\Http\Models\ThemeOption();

        if (is_null($field)) {
            return $themeOptions->getAll()->pluck('key_value', 'name')->toArray();
        }

        $value = $default;

        $themeOptions = $themeOptions->getAll()->pluck('key_value', 'name')->toArray();

        if (array_key_exists($field, $themeOptions)) {
            $value = $themeOptions[$field];
        }

        return $value;
    }
}

/**
 * isSuperAdmin method
 * Check user if super admin? We assume
 * that user with ID 1 and/or Role ID 1 will be super admin.
 * @param integer $userId
 * @return boolean
 */
function isSuperAdmin($userId = null)
{
    // Check Auth if userId is NULL
    if (empty($userId)) {
        $userId = Auth::id();
    }

    // Return false if userId is still NULL
    if (empty($userId)) {
        return false;
    }

    if ($userId == 1) {
        return true;
    }

    $roleID = RoleUser::getRoleIDByUser($userId);

    if ($roleID == 1) {
        return true;
    }

    return false;
}

if (!function_exists('defaultRoles')) {
    function defaultRoles()
    {
        return ['super-admin', 'vendor-admin', 'customer', 'guest'];
    }
}

function defaultImage(string $type)
{
    $defaulImages = [
        'items' => 'public/dist/img/default_product.jpg',
        'users' => 'public/dist/img/avatarUser.png',
        'blogs' => 'public/dist/img/blog.png',
    ];

    if (array_key_exists($type, $defaulImages)) {
        return $defaulImages[$type];
    }

    return 'public/dist/img/default-image.png';
}

function dataTableOptions(array $options = [])
{
    $default = [
        'pageLength' => preference('row_per_page', 25),
        'language'   => ['url' => url('/resources/lang/' . config('app.locale') . '.json')],
        'order'      => [0, 'DESC']
    ];

    return array_merge($default, $options);
}

function labelRequiredElement()
{
    return ['dropdown', 'checkbox', 'checkbox_custom', 'radio', 'radio_custom', 'multiple_select'];
}

function selecItemForOption()
{
    return ['field', 'textarea', 'dropdown', 'checkbox', 'checkbox_custom', 'radio', 'radio_custom', 'multiple_select', 'date', 'date_time', 'time'];
}

function hasPermission($permission = null, $userId = null)
{
    // Check Auth if userId is NULL
    if (empty($userId)) {
        $userId = Auth::id();
    }

    // Return false if userId is still NULL
    if (empty($userId)) {
        return false;
    }

    $roleID = RoleUser::getRoleIDByUser($userId);

    if ($roleID == 1) {
        return true;
    }

    if (is_null($roleID)) {
        return false;
    }

    if (!is_null($permission)) {
        return in_array($permission, PermissionRole::permissionNamesByRoleID($roleID));
    }

    return in_array(request()->route()->getActionName(), PermissionRole::permissionNamesByRoleID($roleID));
}

if (!function_exists('wrapIt')) {
    /**
     * wrapIt function to wrap the string to given lenght
     * If the sidebar menu is collapsed add extra 40 pixels
     * among the colummns
     * @param string $str
     * @param integer $length
     * @param array $options
     * @return string
     */
    function wrapIt($str = '', $length = 10, $options = [])
    {
        if (empty($str)) {
            return '';
        }

        // Get the options
        $options = array_merge(["break" => "<br>\n", "cut" => true, "minWidth" => 1280, 'columns' => 1, 'trim' => false, 'trimLength' => 80], $options);

        // Get window width from cookie
        $width = !empty($_COOKIE['scrwid']) ? $_COOKIE['scrwid'] : 0;
        if ($width < $options['minWidth']) {
            return $str;
        }

        // Get extra length for collapsed navigation bar
        $extra = $_COOKIE['collapsedNavbar'] == "true" ? floor((40 / $options['columns']) + .5)  : 0;

        if (!empty($options['trim'])) {
            $options['trimLength'] += ($extra * 2);
            if (strlen($str) > $options['trimLength']) {
                $str = substr($str, 0, ($options['trimLength'] - 3)) . '...';
            }
        }

        // Get the lenght
        $length += floor((($width - $options['minWidth']) / 10) + .5) + $extra;

        // wrap the string
        return wordwrap($str, $length, $options['break'], $options['cut']);
    }
}

if (!function_exists('statusBadges')) {
    function statusBadges($status = '')
    {
        if (empty($status)) {
            return '';
        }
        $status = strtolower($status);
        $colors = [
            'active' => 'theme-bg-active',
            'inactive' => 'theme-bg-inactive',
            'deleted' => 'theme-bg-deleted',
            'pending' => 'theme-bg-pending',
            'expired' => 'theme-bg2',
            'refunded' => 'theme-bg-r',
            'cancel' => 'theme-bg2',
            'overdued' => 'theme-bg2',
            'paused' => 'theme-bg2',
            'picked up' => 'theme-bg2',
            'on the way' => 'theme-bg2',
            'confirmed' => 'theme-bg2',
            'delivered' => 'theme-bg',
            'paid' => 'theme-bg',
            'unpaid' => 'theme-bg-r',
            'partially paid' => 'theme-bg2',
            'yes' => 'theme-bg-active',
            'no' => 'theme-bg-inactive',
            'accepted' => 'theme-bg-active',
            'rejected' => 'theme-bg-inactive',
            'completed' => 'theme-bg2',
            'opened' => 'theme-bg-pending',
            'in progress' => 'theme-bg-active',
            'declined' => 'theme-bg-deleted'
        ];

        return '<span class="badge ' . $colors[$status] . ' text-white f-12">' . ucfirst(__($status)) .  '</span>';
    }
}

function isActive(String $name = null)
{
    if (is_null($name)) {
        return \Nwidart\Modules\Facades\Module::collections();
    }

    return \Nwidart\Modules\Facades\Module::collections()->has($name);
}

function module(String $name = null)
{
    if (is_null($name)) {
        return \Nwidart\Modules\Facades\Module::all();
    }

    return \Nwidart\Modules\Facades\Module::find($name);
}



/**
 * return item price
 *
 * @param null $discountFrom
 * @param null $discountTo
 * @param null $disountType
 * @param null $discountAmount
 * @param null $mainPrice
 * @param string $type
 * @return float|int|mixed|null
 */
function discountPrice($discountFrom = null, $discountTo = null, $disountType = null, $discountAmount = null, $mainPrice = null, $type = "exactPrice")
{
    $price = $mainPrice;
    $discount = null;
    if (!empty($discountAmount)) {
        if (dateExists($discountFrom, $discountTo)) {
            $discount = $disountType == 'Percent' ? ($mainPrice * $discountAmount / 100) : $discountAmount;
            $price = abs($mainPrice - $discount);
        }
    }
    /*
     *That is one function two works
     *If it needs to exactPrice with discount then type will be exactPrice and
     *If it needs to only discount amount then type will be discountAmount
    */
    return $type == "exactPrice" ? $price : $discount;
}

/**
 * is item has option or not
 *
 * @param null $id
 * @return bool
 */
function hasOption($id = null)
{
    $item = \App\Models\ItemOption::getAll()->where('item_id', $id)->first();
    if (!empty($item)) {
        return true;
    }
    return false;
}



/**
 * get browser agent
 *
 * @return string
 */
function browserAgent()
{
    $browsers = [
        'Edg' => 'Microsoft Edge',
        'MSIE' => 'Internet Explorer',
        'Trident' => 'Internet Explorer',
        'Chrome' => 'Google Chrome',
        'Firefox' => 'Mozilla Firefox',
        'Safari' => 'Apple Safari',
        'Opera Mini' => 'Opera Mini',
        'Opera' => 'Opera',
        'Netscape' => 'Netscape'
    ];

    foreach ($browsers as $key => $value) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], $key) !== FALSE) {
            return $value;
        }
    }

    return 'Unknown';
}

/**
 * get user ip address
 *
 * @return string
 */
function getIpAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}




function getUniqueAddress()
{
    $ip = getIpAddress();
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    return $ip . $userAgent;
}

/**
 *  Check an array multi dimensional or not
 *
 * @return bool
 */
function is_multidimensional(array $array)
{
    return count($array) !== count($array, COUNT_RECURSIVE);
}



/**
 * filter page showing item
 *
 * @return int
 */
function totalItemPerPage()
{
    return 20;
}

/**
 * check item code exists or not
 *
 * @param $code
 * @return bool
 */
function hasItemCodeExists($code = null)
{
    $itemCode = \App\Models\Item::where('item_code', $code);
    if ($itemCode->exists()) {
        return true;
    }
    return false;
}

function findAttributeValue($attributeId = null, $itemId = null)
{
    $itemAttribute = \App\Models\ItemAttribute::getAll()->where('attribute_id', $attributeId)->where('item_id', $itemId)->first();
    if (!empty($itemAttribute)) {
        if (optional($itemAttribute->attribute)->type == "multiple_select") {
            return json_decode($itemAttribute->payloads);
        } else {
            return $itemAttribute->payloads;
        }
    } else {
        return "-";
    }
}

function wishListActive($itemId = null, $userId = null)
{
    $active = \App\Models\Wishlist::where('item_id', $itemId)->where('user_id', $userId);
    if ($active->exists()) {
        return true;
    }
    return false;
}

function getServiceData($type = 0, $period = 0)
{
    if ($type == 1) {
        return ['No Warranty', 'Brand Warranty', 'Seller Warranty'];
    } elseif ($period == 1) {
        return [
            '1 month', '2 months', '3 months', '4 months', '5 months', '6 months', '7 months', '8 months', '9 months', '10 months', '11 months',
            '1 year', '2 years', '3 years', '4 years', '5 years', '6 years', '7 years', '8 years', '9 years', '10 years', '11 years', '12 years', '15 years', '25 years', '30 years', 'Lifetime'
        ];
    }
    return [];
}

function getStatus()
{
    return [
        'Active', 'Inactive', 'Pending'
    ];
}


/**
 * @param $optionId
 * @param $label
 * @return bool
 */
function isStockAvailable($optionId = null, $label = null)
{
    $inventory = \App\Models\Inventory::where('item_option_id', $optionId)->where('label', $label)->first();
    if (!empty($inventory) && $inventory->quantity > 0) {
        return true;
    }
    return false;
}

/**
 * @return void
 */
function getColor()
{
    $color = [
        'red' => "bg-custom-red",
        'pink' => "bg-custom-pinks",
        'yellow' => "bg-custom-yellow",
        'skies' => "bg-custom-skies",
        'white' => "bg-custom-white black-check",
        'green' => "bg-custom-green",
        'gray' => "bg-custom-gray",
        'orange' => "bg-custom-orange",
        'blue' => "bg-custom-blue",
        'black' => "bg-custom-black",
        'purple' => "bg-custom-purple",
        'maroon' => "bg-custom-maroon",
        'beige' => "bg-custom-beige",
    ];
    return $color;
}

/**
 * check recaptcha active status and credential status
 * @return bool
 */
function isRecaptchaActive()
{
    return isActive('Recaptcha') && env('NOCAPTCHA_SITEKEY') != null && env('NOCAPTCHA_SECRET') != null;
}
