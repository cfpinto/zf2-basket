<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 14:54
 */

namespace Zf2Basket\Discount\Decorator;


use Zf2Basket\AbstractBasket;

class MinBasketValue extends AbstractBasketDecorator
{

    private $minValue = 0;

    /**
     * @return int
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * @param int $minValue
     *
     * @return $this
     */
    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;
        return $this;
    }

    /**
     * @return bool
     */
    function isValid()
    {
        if ($this->basket instanceof AbstractBasket && $this->basket->getTotal() >= $this->minValue) {
            return true;
        }

        return false;
    }
}