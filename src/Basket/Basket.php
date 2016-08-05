<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 16:11
 */

namespace Basket;

use Basket\Discount\DiscountInterface;
use Basket\Product\AbstractProduct;

class Basket extends AbstractBasket {


    /**
     * @param AbstractProduct $item
     * @param int             $quantity
     *
     * @return $this
     */
    function addItem(AbstractProduct $item, $quantity = 1)
    {
        $this->getContainer()->add();
    }

    /**
     * @param AbstractProduct $item
     * @param int             $quantity
     *
     * @return $this
     */
    function removeItem(AbstractProduct $item, $quantity = 1)
    {
        // TODO: Implement removeItem() method.
    }

    /**
     * @param AbstractProduct $item
     *
     * @return $this
     */
    function clearItem(AbstractProduct $item)
    {
        // TODO: Implement clearItem() method.
    }

    /**
     * @return $this
     */
    function clearItems()
    {
        // TODO: Implement clearItems() method.
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