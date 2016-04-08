<?php

/*
|   A short name, parameters for escaping with htmlentities.
*/
function e($string)
{
    return htmlentities(trim($string), ENT_QUOTES, 'UTF-8', false);
}

/*
|   Generate random strings.
*/
function str_random($length = false)
{
    $random = str_shuffle('qwerQWtyuiopGHJKLZXCVBNMasdfghjklzxcvbnmOPASDF');
    if($length != false)
        return substr($random, 0, $length);

    return $random;
}

/*
|   Die & Dump either in JSON format or simply var_dump.
*/
function dd($object, $jsonEncode = false)
{
    if($jsonEncode != false)
        return die(json_encode($object));
    return die(var_dump($object));
}

/*
|   Easy way to get TIMESTAMP in TimeAgo format
*/
function TimeAgo($time)
{
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = time();

    $difference = $now - $time;
    $tense      = "ago";

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++)
        $difference /= $lengths[$j];

    $difference = round($difference);

    if ($difference != 1)
        $periods[$j] .= "s";

    return "$difference $periods[$j] ago";
}

/*
|   Getting REQUEST_METHOD
*/
function request_method($method = false)
{
    $req_method = strtolower($_SERVER['REQUEST_METHOD']);

    if($method != false) {
        if($req_method == strtolower($method))
            return true;
        else
            return false;
    }

    return $req_method;
}

/*
|   Array sanitizer, mainly used to sanitize HTTP REQUESTS.
*/
function SanitizeArray($array)
{
    return array_map('e', $array);
}

/*
|   Route linker.
*/
function Route($route_addr = '')
{
    return BASE_URL . $route_addr;
}

/*
|   Redirect user
*/
function Redirect($url)
{
    header('Location: ' . $url);
    exit(0);
}

/*
|   Print VALUE attribute of HTML input element.
*/
function getValueFromPost($PostName)
{
    if(isset($_POST[$PostName])) {
        return ' value="' . e($_POST[$PostName]) . '"';
    }
}

/*
|   Checks if URL is valid or not
|   If valid then will return the clean URL, which won't
|   contain HTTP or HTTP or www. before URL.
*/
function check_url($url = false)
{
    if($url == false)
        return false;

    $url = str_ireplace('http://', '', $url);
    $url = str_ireplace('https://', '', $url);
    $url = str_ireplace('www.', '', $url);

    $url = explode('/', $url);
    $url = $url[0];

    return $url;
}

function isCookie()
{
    if(!isset($_SESSION['cookie_check']))
        Redirect(Route('/cookie'));
}