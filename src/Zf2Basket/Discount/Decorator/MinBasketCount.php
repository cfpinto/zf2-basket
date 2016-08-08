<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 14:53
 */

namespace Zf2Basket\Discount\Decorator;


class MinBasketCount extends AbstractBasketDecorator
{

    private $minCount = 0;

    /**
     * @return int
     */
    public function getMinCount()
    {
        return $this->minCount;
    }

    /**
     * @param int $minCount
     *
     * @return $this
     */
    public function setMinCount($minCount)
    {
        $this->minCount = $minCount;
        return $this;
    }

    /**
     * @return bool
     */
    function isValid()
    {
        if ($this->basket instanceof AbstractBasket && $this->basket->count() >= $this->minCount) {
            return true;
        }

        return false;
    }
}