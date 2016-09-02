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

class MinBasketCount extends AbstractDecorator
{
    /**
     * @var int
     */
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
     * @param ProductInterface $item
     * @param AbstractBasket  $basket
     *
     * @return bool
     */
    function isValid(ProductInterface $item = null, AbstractBasket $basket = null)
    {
        if ($basket instanceof AbstractBasket && $basket->getContainer()->count() >= $this->minCount) {
            return true;
        }

        return false;
    }
}