<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
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
        $basket->setServiceLocator($serviceLocator);
        $basket->setEventManager($serviceLocator->get('EventManager'));
        return $basket;
    }
}