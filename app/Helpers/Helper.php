<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Authorization\AuthorizationChecker;

if(!function_exists('bdDate')){
    function bdDate($date){
        return Carbon::parse($date)->format('d/m/Y');
    }
}

if(!function_exists('ageWithDays')){
    function ageWithDays($d_o_b){
        return Carbon::parse($d_o_b)->diff(Carbon::now())->format('%y years, %m months and %d days');
    }
}
if(!function_exists('ageWithMonths')){
    function ageWithMonths($d_o_b){
        return Carbon::parse($d_o_b)->diff(Carbon::now())->format('%y years, %m months');
    }
}

if (!function_exists('imageStore')) {
    function imageStore(Request $request, $requestName, string $name, string $path)
    {
        if($request->hasFile($requestName)){
            $pathCreate = public_path().$path;
            !file_exists($pathCreate) ?? File::makeDirectory($pathCreate, 0777, true, true);

            $image = $request->file($requestName);
            $image_name = $name . uniqueId(10).'.'.$image->getClientOriginalExtension();
            if ($image->isValid()) {
                $request->image->move($path,$image_name);
                return $image_name;
            }
        }
    }
}

if (!function_exists('imageUpdate')) {
    function imageUpdate(Request $request, $request_name ,string $name, string $path, $image)
    {
        if($request->hasFile($request_name)){
            $deletePath =  public_path($path.$image);
            if(file_exists($deletePath) && $image != ''){
                unlink($deletePath);
            }
            // file_exists($deletePath) ? unlink($deletePath) : false;
            $createPath = public_path().$path;
            !file_exists($createPath) ?? File::makeDirectory($createPath, 0777, true, true);

            $image = $request->file($request_name);
            $image_name = $name . uniqueId(20).'.'.$image->getClientOriginalExtension();
            if ($image->isValid()) {
                $request->image->move($path,$image_name);
                return $image_name;
            }
        }
    }
}

if(!function_exists('profileImg')){
    function profileImg(){
        if(file_exists(asset('uploads/images/user/'.user()->image))){
            return asset('uploads/images/user/'.user()->image);
        }else{
            return asset('uploads/images/user/profile_blank.png');
        }
    }
}


if (!function_exists('imagePath')) {
    function imagePath($folder, $image)
    {
        $path = 'uploads/images/'.$folder.'/'.$image;
        if(@GetImageSize($path)){
            return asset($path);
        }else{
            // return setting('app_logo');
        }
    }
}

if (!function_exists('transaction_id')) {
    function transaction_id($src = '', $length = 12)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        if ($src != '') {
            return strtoupper($src.'_'.substr(bin2hex($bytes), 0, $length));
        }
        return strtoupper(substr(bin2hex($bytes), 0, $length));
    }
}

if (!function_exists('activeSubNav')) {
    function activeSubNav($route)
    {
        if (is_array($route)) {
            $rt = '';
            foreach ($route as $rut) {
                $rt .= request()->routeIs($rut) || '';
            }
            return $rt ? ' mm-active ' : '';
        }
        return request()->routeIs($route) ? ' mm-active ' : '';
    }
}

if (!function_exists('activeNav')) {
    function activeNav($route)
    {
        if (is_array($route)) {
            $rt = '';
            foreach ($route as $rut) {
                $rt .= request()->routeIs($rut) || '';
            }
            return $rt ? ' mm-active ' : '';
        }
        return request()->routeIs($route) ? ' mm-active ' : '';
    }
}

if (!function_exists('openNav')) {
    function openNav(array $routes)
    {
        $rt = '';
        foreach ($routes as $route) {
            $rt .= request()->routeIs($route) || '';
        }
        return $rt ? ' mm-collapse mm-show ' : '';
    }
}
if (!function_exists('userCan')) {
    function userCan($permission)
    {
        if (auth()->check() && user()->can($permission)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('roleName')) {
    function roleName($roles)
    {
        $r = '';
        foreach ($roles->where('name', '!=', 'client') as $role) {
            $r .= '<span class="badge badge-info">' . ucfirst(explode('@uid', $role->name)[0]) . '</span>';
        }
        return $r;
    }
}
if (!function_exists('trimRoleAdmin')) {
    function trimRoleAdmin($roles)
    {
        return str_replace('-', ' ', $roles);
    }
}
if (!function_exists('trimRole')) {
    function trimRole($val)
    {
        return str_replace('-', ' ', explode('@uid', $val)[0]);
    }
}


if (!function_exists('uniqueId')) {
    function uniqueId($lenght = 8)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
}

if (!function_exists('user')) {
    function user()
    {
        return auth()->user();
    }
}

if (!function_exists('slug')) {
    function slug($slug)
    {
        return Str::slug($slug);
    }
}

if (!function_exists('bn_slug')) {
    function bn_slug($text)
    {
        $array = [':', ',', '.', '!', '|', '।', 'ঃ', '{', '}', '[', ']', '(', ')', '৳', '%', '$', '#', '@', '*', '+', ';'];
        $slug = strtolower(str_replace($array, '', trim($text)));
        return str_replace(' ', '-', $slug);
        return strtolower(preg_replace('/\s+/u', '-', trim($text)));
    }
}

if (!function_exists('readableSize')) {
    function readableSize($n)
    {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) {
            return $n;
        }
        // now filter it;
        if ($n >= 1000000000000) {
            return round(($n / 1000000000000), 1) . ' T';
        } elseif ($n >= 1000000000) {
            return round(($n / 1000000000), 1) . ' B';
        } elseif ($n >= 1000000) {
            return round(($n / 1000000), 1) . ' M';
        } elseif ($n >= 1000) {
            return round(($n / 1000), 1) . ' K';
        }
        return number_format($n);
    }
}

if (!function_exists('niceFileSize')) {
    function niceFileSize($bytes)
    {
        $result = '';
        $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach ($arBytes as $arItem) {
            if ($bytes >= $arItem["VALUE"]) {
                $result = $bytes / $arItem["VALUE"];
                $result = strval(round($result, 2)) . " " . $arItem["UNIT"];
                break;
            }
        }
        return $result;
    }

    /**
     * Converts a number to its roman presentation.
     **/
    if (!function_exists('numberToRoman')) {
        function numberToRoman($num)
        {
            // Be sure to convert the given parameter into an integer
            $n = intval($num);
            $result = '';
            // Declare a lookup array that we will use to traverse the number:
            $lookup = array(
                'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
                'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
                'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
            );
            foreach ($lookup as $roman => $value)
            {
                // Look for number of matches
                $matches = intval($n / $value);
                // Concatenate characters
                $result .= str_repeat($roman, $matches);
                // Substract that from the number
                $n = $n % $value;
            }
            return $result;
        }
    };
}


