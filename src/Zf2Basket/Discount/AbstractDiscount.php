<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 09/08/2016
 * Time: 14:04
 */

namespace Zf2Basket\Discount;


use Zf2Basket\AbstractBasket;
use Zf2Basket\Discount\Decorator\DecoratorInterface;
use Zf2Basket\Product\ProductInterface;

abstract class AbstractDiscount implements DiscountInterface
{
    protected $decorators = [];


    final public function getDecorators()
    {
        return $this->decorators;
    }

    final public function addDecorator(DecoratorInterface $decorator)
    {
        if (!isset($this->decorators[get_class($decorator)])) {
            $this->decorators[get_class($decorator)] = $decorator;
        }
    }

    final public function removeDecorator(DecoratorInterface $decorator)
    {
        if (!isset($this->decorators[get_class($decorator)])) {
            unset($this->decorators[get_class($decorator)]);
        }
    }

    public function isValid(ProductInterface $item = null, AbstractBasket $basket = null)
    {
        /** @var DecoratorInterface $decorator */
        foreach ($this->decorators as $decorator) {
            if (!$decorator->isValid($item, $basket)) {
                return false;
            }
        }

        return true;
    }
}