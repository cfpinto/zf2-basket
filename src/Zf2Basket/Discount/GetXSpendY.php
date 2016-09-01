<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 09/08/2016
 * Time: 13:53
 */

namespace Zf2Basket\Discount;


use Zf2Basket\AbstractBasket;
use Zf2Basket\Discount\Decorator\MinBasketValue;
use Zf2Basket\Product\ProductInterface;
use Zf2Basket\Product\Exception;

class GetXSpendY extends AbstractDiscount
{
    private $value;

    private $spend;

    private $applied;

    function __construct($value, $spend)
    {
        $this->setValue($value);
        $this->setSpend($spend);
        $minValueDecorator = new MinBasketValue();
        $minValueDecorator->setMinValue($spend);
        $this->addDecorator($minValueDecorator);
        return $this;
    }

    public function getId()
    {
        return sprintf('get%dspend%d', $this->getValue(), $this->getSpend());
    }

    public function getItemPriceDiscounted(ProductInterface $item)
    {
        return $item->price;
    }

    public function getItemPriceDiscount(ProductInterface $item)
    {
        return 0;
    }

    public function getTotalPriceDiscounted(AbstractBasket $basket)
    {
        if ($this->isValid(null, $basket)) {
            return $basket->getTotal() - $this->getValue();
        }

        return $basket->getTotal();
    }

    public function getTotalPriceDiscount(AbstractBasket $basket)
    {
        if ($this->isValid(null, $basket)) {
            return $this->getValue();
        }

        return 0;
    }

    /**
     * @return mixed
     */
    public function getSpend()
    {
        return $this->spend;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $spend
     *
     * @return $this
     * @throws Exception
     */
    public function setSpend($spend)
    {
        if ($spend < $this->value) {
            throw new Exception("Spend must be higher than value.");
        }
        $this->spend = $spend;
        $this->applied = 0;
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     * @throws Exception
     */
    public function setValue($value)
    {
        if (!empty($this->spend) && $value > $this->spend) {
            throw new Exception("Spend must be higher than value.");
        }
        $this->value = $value;
        $this->applied = 0;
        return $this;
    }

    public function getName()
    {
        return sprintf('Get %s if you spend %s', $this->value, $this->spend);
    }

    public function getDescription()
    {
        return sprintf('Get %s%% discount when you spend £%s', $this->value, $this->spend);
    }
}