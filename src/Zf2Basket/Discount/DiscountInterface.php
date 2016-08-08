<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 16:29
 */

namespace Zf2Basket\Discount;


use Zf2Basket\AbstractBasket;
use Zf2Basket\Discount\Decorator\DecoratorInterface;
use Zf2Basket\Product\AbstractProduct;

interface DiscountInterface
{
    public function getId();

    public function getItemPriceDiscounted(AbstractProduct $item );

    public function getItemPriceDiscount(AbstractProduct $item );

    public function getDecorators();

    public function addDecorator(DecoratorInterface $decorator);

    public function removeDecorator(DecoratorInterface $decorator);

    public function isValid(AbstractProduct $item, AbstractBasket $basket);

}