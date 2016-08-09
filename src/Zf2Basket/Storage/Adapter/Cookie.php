<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 04/08/2016
 * Time: 10:15
 */

namespace Zf2Basket\Storage\Adapter;


use Zf2Basket\Storage\Container;
use Zf2Basket\Storage\Exception;
use Zf2Basket\Storage\StorageAdapterInterface;
use Zf2Basket\Helper\Cookie as CookieHelper;

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
        return unserialize(CookieHelper::get($this->getCookieName(), serialize(new Container())));
    }

    function delete()
    {
        CookieHelper::delete($this->getCookieName());
        return $this;
    }
}