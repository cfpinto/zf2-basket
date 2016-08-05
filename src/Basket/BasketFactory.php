<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 17:29
 */

namespace Basket;


use Basket\Storage\Container;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BasketFactory implements FactoryInterface
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
        $basket = new Basket($serviceLocator->get('Basket\Storage\Adapter'), new Container());
        $basket->setServiceLocator($serviceLocator);
        $basket->setEventManager($serviceLocator->get('EventManager'));
        return $basket;
    }
}