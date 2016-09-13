<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 13/09/2016
 * Time: 09:19
 */

namespace Zf2Basket;


use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ControllerPlugin extends AbstractPlugin
{
    function __invoke()
    {
        return $this->getController()->getServiceLocator()->get(Zf2Basket::class);
    }

    function __call($name, $arguments)
    {
        return call_user_func_array([$this->getController()->getServiceLocator()->get(Zf2Basket::class), $name], $arguments);
    }
}