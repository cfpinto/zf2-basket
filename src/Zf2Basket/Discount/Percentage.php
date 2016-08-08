<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 15:42
 */

namespace Zf2Basket\Discount;

use Zf2Basket\AbstractBasket;
use Zf2Basket\Discount\Decorator\DecoratorInterface;
use Zf2Basket\Discount\Decorator\Regular;
use Zf2Basket\Product\AbstractProduct;

class Percentage implements DiscountInterface
{
    private $value;

    private $decorators = [];

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getItemPriceDiscounted(AbstractProduct $item)
    {
        return round($item->price * (100 - $this->getValue()) / 100, 2);
    }

    public function getItemPriceDiscount(AbstractProduct $item)
    {
        return round($item->price - $this->getItemPriceDiscounted($item), 2);
    }

    public function getDecorators()
    {
        return $this->decorators;
    }

    public function addDecorator(DecoratorInterface $decorator)
    {
        if (!isset($this->decorators[get_class($decorator)])) {
            $this->decorators[get_class($decorator)] = $decorator;
        }
    }

    public function removeDecorator(DecoratorInterface $decorator)
    {
        if (!isset($this->decorators[get_class($decorator)])) {
            unset($this->decorators[get_class($decorator)]);
        }
    }

    public function isValid(AbstractProduct $item, AbstractBasket $basket)
    {
        /** @var DecoratorInterface $decorator */
        foreach ($this->decorators as $decorator) {
            if (!$decorator->isValid($item, $basket)) {
                return false;
            }
        }

        return true;
    }

    public function getId()
    {
        return $this->getValue() . '%';
    }
}