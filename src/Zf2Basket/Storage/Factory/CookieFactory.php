<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 04/08/2016
 * Time: 17:30
 */

namespace Zf2Basket\Storage\Factory;


use Zf2Basket\Storage\Adapter\Cookie;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CookieFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        return new Cookie(session_name(), $config['storage_adapter']['cookie']);
    }
}