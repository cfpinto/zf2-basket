<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 17:29
 */

namespace Zf2Basket;


use Zf2Basket\Storage\Container;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Zf2BasketFactory implements FactoryInterface
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
        $basket = new Zf2Basket($serviceLocator->get('Zf2Basket\Storage\Adapter'), new Container());
        $basket->setServiceLocator($serviceLocator)
            ->setEventManager($serviceLocator->get('EventManager'))
            ->init();
        return $basket;
    }
}