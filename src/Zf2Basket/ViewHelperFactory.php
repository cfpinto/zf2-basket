<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 13/09/2016
 * Time: 09:19
 */

namespace Zf2Basket;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewHelperFactory implements FactoryInterface
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
        return new ViewHelper($serviceLocator->get(Zf2Basket::alias));
    }
}