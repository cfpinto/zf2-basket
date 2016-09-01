<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 15:42
 */

namespace Zf2Basket\Discount;

use Zf2Basket\AbstractBasket;
use Zf2Basket\Product\ProductInterface;
use Zf2Basket\Storage\Container;

class Percentage extends AbstractDiscount
{
    private $value;

    function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getItemPriceDiscounted(ProductInterface $item)
    {
        return round($item->price * (100 - $this->getValue()) / 100, 2);
    }

    public function getItemPriceDiscount(ProductInterface $item)
    {
        return round($item->price - $this->getItemPriceDiscounted($item), 2);
    }

    public function getId()
    {
        return $this->getValue() . '%';
    }

    public function getTotalPriceDiscounted(AbstractBasket $basket)
    {
        $value = 0;
        foreach ($basket->getContainer()->getItems() as $item) {
            /** @var ProductInterface $object */
            $object = $item[Container::KEY_PRODUCT_OBJECT];
            if ($this->isValid($object, $basket)) {
                $value += ($this->getItemPriceDiscounted($object) * $item[Container::KEY_QUANTITY]);
            }
        }
        return $value;
    }

    public function getTotalPriceDiscount(AbstractBasket $basket)
    {
        $value = 0;
        foreach ($basket->getContainer()->getItems() as $item) {
            /** @var ProductInterface $object */
            $object = $item[Container::KEY_PRODUCT_OBJECT];
            if ($this->isValid($object, $basket)) {
                $value += ($this->getItemPriceDiscount($object) * $item[Container::KEY_QUANTITY]);
            }
        }
        return $value;
    }

    public function getName()
    {
        return sprintf('%d%% off', $this->value);
    }

    public function getDescription()
    {
        return sprintf('Get %d%% discount on all products', $this->value);
    }
}