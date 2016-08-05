<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 16:11
 */

namespace Zf2Basket;

use Zf2Basket\Discount\DiscountInterface;
use Zf2Basket\Product\AbstractProduct;

class Basket extends AbstractBasket {


    /**
     * @param AbstractProduct $item
     * @param int             $quantity
     *
     * @return $this
     */
    function addItem(AbstractProduct $item, $quantity = 1)
    {
        $this->getContainer()->increment($item, abs($quantity));
        $this->write();
        return $this;
    }

    /**
     * @param AbstractProduct $item
     * @param int             $quantity
     *
     * @return $this
     */
    function removeItem(AbstractProduct $item, $quantity = 1)
    {
        $this->getContainer()->increment($item, abs($quantity) * -1);
        $this->write();
        return $this;
    }

    /**
     * @param AbstractProduct $item
     *
     * @return $this
     */
    function clearItem(AbstractProduct $item)
    {
        return $this->removeItem($item, $this->getContainer()->count($item));
    }

    /**
     * @return $this
     */
    function clearItems()
    {
        $this->getContainer()->clear();
        $this->write();
        return $this;
    }

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    function addDiscount(DiscountInterface $discount)
    {
        // TODO: Implement addDiscount() method.
    }

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    function removeDiscount(DiscountInterface $discount)
    {
        // TODO: Implement removeDiscount() method.
    }

    /**
     * @return $this
     */
    function clearDiscounts()
    {
        // TODO: Implement clearDiscounts() method.
    }
}