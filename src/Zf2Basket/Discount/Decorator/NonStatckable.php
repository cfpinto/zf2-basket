<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 15:00
 */

namespace Zf2Basket\Discount\Decorator;


use Zf2Basket\AbstractBasket;

class NonStackable extends AbstractBasketDecorator
{
    function isValid()
    {
        return $this->basket->getContaier()->countDiscounts() === 0;
    }
}