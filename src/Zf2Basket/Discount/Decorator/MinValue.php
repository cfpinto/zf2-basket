<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 14:53
 */

namespace Zf2Basket\Discount\Decorator;


class MinValue extends AbstractProductDecorator
{

    private $minValue;

    /**
     * @return mixed
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * @param mixed $minValue
     */
    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;
    }

    function isValid()
    {
        if ($this->container->count($this->product) * $this->product->price >= $this->minValue) {
            return true;
        }

        return false;
    }
}