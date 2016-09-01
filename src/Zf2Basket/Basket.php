<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 04/08/2016
 * Time: 16:11
 */

namespace Zf2Basket;

use Zf2Basket\Administration\AdministrationInterface;
use Zf2Basket\Discount\DiscountInterface;
use Zf2Basket\Product\Exception;
use Zf2Basket\Product\ProductInterface;
use Zf2Basket\Storage\Container;

class Basket extends AbstractBasket
{
    /**
     * @param ProductInterface $item
     * @param int              $quantity
     *
     * @return $this
     * @throws Exception
     */
    function addItem(ProductInterface $item, $quantity = 1)
    {
        if ($item->isTaxable() && !$item->hasOwnTax()) {
            if (!$this->getAdministration()) {
                throw new Exception("Products that are taxable and don't have own tax require an administration to be setup. please add an administration to the basket prior to adding a product.");
            }
            $item->setTax($this->getAdministration()->getTax());
        }
        $this->getContainer()->increment($item, abs($quantity));
        $this->write();
        return $this;
    }

    /**
     * @param ProductInterface $item
     * @param int              $quantity
     *
     * @return $this
     */
    function removeItem(ProductInterface $item, $quantity = 1)
    {
        $this->getContainer()->increment($item, abs($quantity) * -1);
        $this->write();
        return $this;
    }

    /**
     * @param ProductInterface $item
     *
     * @return $this
     */
    function clearItem(ProductInterface $item)
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
            $value += $item[Container::KEY_PRODUCT_OBJECT]->price * $item[Container::KEY_QUANTITY];
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
            $value += $item[Container::KEY_PRODUCT_OBJECT]->priceTax * $item[Container::KEY_QUANTITY];
        }
        return $value;
    }

    /**
     * @return float
     */
    function getTotalDiscounted()
    {
        return $this->getTotal() - $this->getTotalDiscount();
    }

    /**
     * @return float
     */
    function getTotalDiscount()
    {
        $value = 0;

        /** @var DiscountInterface $discount */
        foreach ($this->getContainer()->getDiscounts() as $discount) {
            $value += $discount->getTotalPriceDiscount($this);
        }

        return $value;
    }

    public function toArray()
    {
        $discounts = [];
        /** @var DiscountInterface $discount */
        foreach ($this->getContainer()->getDiscounts() as $discount) {
            $discounts[] = $discount->toArray();
        }
        $items = [];
        /** @var ProductInterface $item */
        foreach ($this->getContainer()->getItems() as $item) {
            $items[] = array_merge($item[Container::KEY_PRODUCT_OBJECT]->toArray(), ['quantity' => $item[Container::KEY_QUANTITY]]);
        }
        return [
            'items' => $items,
            'discounts' => $discounts,
            'total' => $this->getTotal(),
            'totalDiscounted' => $this->getTotalDiscounted(),
            'totalDiscount' => $this->getTotalDiscount(),
        ];
    }
}