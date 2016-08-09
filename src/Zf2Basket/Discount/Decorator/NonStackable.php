<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 15:00
 */

namespace Zf2Basket\Discount\Decorator;


use Zf2Basket\AbstractBasket;
use Zf2Basket\Product\ProductInterface;

class NonStackable implements DecoratorInterface
{
    function isValid(ProductInterface $item = null, AbstractBasket $basket = null)
    {
        return count($basket->getContainer()->getDiscounts()) === 0;
    }
}