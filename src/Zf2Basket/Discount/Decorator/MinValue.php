<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 14:53
 */

namespace Zf2Basket\Discount\Decorator;


use Zf2Basket\AbstractBasket;
use Zf2Basket\Product\ProductInterface;

class MinValue  extends AbstractDecorator
{

    /**
     * @var int
     */
    private $minValue = 0;

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

    function isValid(ProductInterface $item = null, AbstractBasket $basket = null)
    {
        if ($basket->getContainer()->count($item) * $item->price >= $this->minValue) {
            return true;
        }

        return false;
    }
}