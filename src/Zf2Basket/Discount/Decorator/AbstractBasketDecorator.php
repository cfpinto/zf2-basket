<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 15:05
 */

namespace Zf2Basket\Discount\Decorator;


abstract class AbstractBasketDecorator implements DecoratorInterface
{
    protected $basket;

    function __construct(AbstractBasket $basket)
    {
        $this->setBasket($basket);
    }

    /**
     * @return mixed
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * @param mixed $basket
     */
    public function setBasket($basket)
    {
        $this->basket = $basket;
    }

    abstract function isValid();
}