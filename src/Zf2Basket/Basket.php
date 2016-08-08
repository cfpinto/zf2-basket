<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 16:11
 */

namespace Zf2Basket;

use Zf2Basket\Administration\AdministrationInterface;
use Zf2Basket\Discount\DiscountInterface;
use Zf2Basket\Product\AbstractProduct;
use Zf2Basket\Storage\Container;

class Basket extends AbstractBasket
{
    /**
     * @param AbstractProduct $item
     * @param int             $quantity
     *
     * @return $this
     */
    function addItem(AbstractProduct $item, $quantity = 1)
    {
        if ($item->isTaxable() && !$item->hasOwnTax()) {
            $item->setTax($this->getAdministration()->getTax());
        }
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
        return $this;
    }

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    function addDiscount(DiscountInterface $discount)
    {
        $this->getContainer()->addDiscount($discount);
        $this->write();
        return $this;
    }

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    function removeDiscount(DiscountInterface $discount)
    {
        $this->getContainer()->removeDiscount($discount);
        $this->write();
        return $this;
    }

    /**
     * @return $this
     */
    function clearDiscounts()
    {
        $this->getContainer()->setDiscounts([]);
        $this->write();
        return $this;
    }

    /**
     * @param AdministrationInterface $administration
     *
     * @return $this
     */
    function setAdministration(AdministrationInterface $administration)
    {
        $this->administration = $administration;
        return $this;
    }

    /**
     * @return AdministrationInterface
     */
    function getAdministration()
    {
        return $this->administration;
    }

    /**
     * @return float
     */
    function getTotal()
    {
        $value = 0.00;
        foreach ($this->getContainer()->getItems() as $item) {
            $value += $item[Container::KEY_PRODUCT_OBJECT]->price;
        }
        return $value;
    }

    /**
     * @return float
     */
    function getTotalTax()
    {
        $value = 0.00;
        foreach ($this->getContainer()->getItems() as $item) {
            $value += $item[Container::KEY_PRODUCT_OBJECT]->priceTax;
        }
        return $value;
    }

    /**
     * @return float
     */
    function getTotalDiscounted()
    {
        if (count($this->getContainer()->getDiscounts())) {
            $value = 0.00;
            foreach ($this->getContainer()->getItems() as $item) {
                /** @var AbstractProduct $obj */
                $obj = $item[Container::KEY_PRODUCT_OBJECT];
                /** @var DiscountInterface $discount */
                foreach ($this->getContainer()->getDiscounts() as $discount) {
                    if ($discount->isValid($obj, $this)) {
                        $value += $discount->getItemPriceDiscounted($obj);
                    } else {
                        $value += $obj->price;
                    }
                }
            }
            return $value;
        }

        return $this->getTotal();
    }

    /**
     * @return float
     */
    function getTotalDiscount()
    {
        return $this->getTotal() - $this->getTotalDiscounted();
    }
}