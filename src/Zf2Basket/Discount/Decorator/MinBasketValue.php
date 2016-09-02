<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 14:54
 */

namespace Zf2Basket\Discount\Decorator;


use Zf2Basket\AbstractBasket;
use Zf2Basket\Product\ProductInterface;

class MinBasketValue extends AbstractDecorator
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
     * @param ProductInterface $item
     * @param AbstractBasket  $basket
     *
     * @return bool
     */
    function isValid(ProductInterface $item = null, AbstractBasket $basket = null)
    {
        if ($basket instanceof AbstractBasket && $basket->getTotal() >= $this->minValue) {
            return true;
        }

        return false;
    }
}