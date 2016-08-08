<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 15:05
 */

namespace Zf2Basket\Discount\Decorator;


use Zf2Basket\Product\AbstractProduct;
use Zf2Basket\Storage\Container;

abstract class AbstractProductDecorator implements DecoratorInterface
{
    /**
     * @var AbstractProduct
     */
    protected $product;

    /**
     * @var Container
     */
    protected $container;

    function __construct(AbstractProduct $basket, Container $container)
    {
        $this->setProduct($basket);
        $this->setContainer($container);
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param mixed $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * @return AbstractProduct
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param AbstractProduct $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    abstract function isValid();
}