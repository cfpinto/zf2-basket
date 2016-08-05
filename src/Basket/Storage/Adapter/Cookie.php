<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 10:15
 */

namespace Basket\Storage\Adapter;


use Basket\Storage\Container;
use Basket\Storage\Exception;
use Basket\Storage\StorageAdapterInterface;
use Basket\Helper\Cookie as CookieHelper;

class Cookie implements StorageAdapterInterface
{
    private $cookieName;

    /**
     * @return string
     */
    public function getCookieName()
    {
        return $this->cookieName;
    }

    function __construct($identity, $config)
    {
        if (!isset($config[StorageAdapterInterface::CONFIG_NAME])) {
            throw new Exception("The cookie configuration is invalid, review your module config file.");
        }

        $this->cookieName = md5($identity . $config[StorageAdapterInterface::CONFIG_NAME]);
    }

    function put(Container $basketContainer)
    {
        CookieHelper::set($this->getCookieName(), serialize($basketContainer), 1, CookieHelper::EXP_TYPE_SEVEN_DAYS);
        return $this;
    }

    function pull()
    {
        return CookieHelper::get($this->getCookieName());
    }

    function delete()
    {
        CookieHelper::delete($this->getCookieName());
        return $this;
    }
}