<?php

use Illuminate\Support\Facades\Request;

if(!function_exists('is_admin')){
    function is_admin():bool{
        return (auth()->check() && auth()->user()->is_admin) ? true : false;
    }
}

if(!function_exists('is_user')){
    function is_user():bool{
        return (auth()->check()) ? true : false;
    }
}

if(!function_exists('is_guest')){
    function is_guest():bool{
        return (auth()->check()) ? false : true;
    }
}
if(!function_exists('is_route_active')){
    function is_route_active($route, $value = "active"):string{
        if (is_array($route)){
            return (in_array(request()->route()->getName(), $route)) ? $value : '';
        }else{
            return (request()->route()->getName() == $route) ? $value : '';
        }
    }
}
if(! function_exists('sendTelegram')){
    function sendTelegram($chat_id = 'me', $message = 'test'): bool
    {
        try {
            if ($chat_id == 'me'){
                $chat_id = '127622235';
            }elseif ($chat_id == 'group'){
                $chat_id = '-1001856768639';
            }
            app('App\Service\Telegram\Telegram')->debugSender($message, $chat_id);
            return true;
        }catch (Exception $exception){
            return false;
        }

    }
}

if (! function_exists('price')) {
    function price($price, $currency = 'UZS'){
        if($currency == 'percent'){
            $currency = '%';
        }
        return number_format($price, 0, ' ', ' ').' '.$currency;
    }
}

if (! function_exists('setEnv')) {
    function setEnv($key, $value): void
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }
}

require_once 'Statistics.php';
