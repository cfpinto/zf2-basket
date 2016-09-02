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

class MinCount extends AbstractDecorator
{

    /**
     * @var int
     */
    private $minCount = 0;

    /**
     * @return mixed
     */
    public function getMinCount()
    {
        return $this->minCount;
    }

    /**
     * @param mixed $minCount
     */
    public function setMinCount($minCount)
    {
        $this->minCount = $minCount;
    }

    function isValid(ProductInterface $item = null, AbstractBasket $basket = null)
    {
        if ($basket->getContainer()->count($item) >= $this->minCount) {
            return true;
        }

        return false;
    }
}