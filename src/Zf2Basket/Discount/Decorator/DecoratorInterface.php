<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 14:53
 */

namespace Zf2Basket\Discount\Decorator;


use Zf2Basket\AbstractBasket;
use Zf2Basket\Product\AbstractProduct;

interface DecoratorInterface
{
    function isValid(AbstractProduct $item, AbstractBasket $basket);
}