<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 10:19
 */

namespace Basket\Helper;


class Cookie
{
    const EXP_TYPE_SESSION = 0;
    const EXP_TYPE_ONE_MINUTE = 60;
    const EXP_TYPE_ONE_HOUR = 3600;
    const EXP_TYPE_ONE_DAY = 86400;
    const EXP_TYPE_SEVEN_DAYS = 604800;
    const EXP_TYPE_THIRTY_DAYS = 2592000;
    const EXP_TYPE_SIX_MONTH = 15811200;
    const EXP_TYPE_ONE_YEAR = 31536000;
    const EXP_TYPE_LIFETIME = 1893456000;

    public static function set($name, $value, $expire = 1, $expireType = self::EXP_TYPE_ONE_DAY)
    {
        if (!headers_sent()) {
            return @setcookie($name, $value, time() + ($expire * $expireType), '/', $_SERVER['SERVER_NAME']);
        }

        return false;
    }

    public static function get($name, $default = null)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }

        return $default;
    }

    public static function delete($name)
    {
        unset($_COOKIE[$name]);
        return @setcookie($name, '', time() - self::EXP_TYPE_ONE_DAY, '/', $_SERVER['SERVER_NAME']);
    }
}