<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 09/08/2016
 * Time: 14:04
 */

namespace Zf2Basket\Discount;


use Zf2Basket\AbstractBasket;
use Zf2Basket\Discount\Decorator\DecoratorInterface;
use Zf2Basket\Product\ProductInterface;
abstract class AbstractDiscount implements DiscountInterface
{
    private $decorators = [];

    private $errors = [];

    /**
     * @return array
     */
    final public function getDecorators()
    {
        return $this->decorators;
    }

    /**
     * @param DecoratorInterface $decorator
     *
     * @return $this
     */
    final public function addDecorator(DecoratorInterface $decorator)
    {
        if (!isset($this->decorators[get_class($decorator)])) {
            $this->decorators[get_class($decorator)] = $decorator;
        }

        return $this;
    }

    /**
     * @param DecoratorInterface $decorator
     *
     * @return $this
     */
    final public function removeDecorator(DecoratorInterface $decorator)
    {
        if (!isset($this->decorators[get_class($decorator)])) {
            unset($this->decorators[get_class($decorator)]);
        }

        return $this;
    }

    /**
     * @return array
     */
    final public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'type' => $this->getType(),
        ];
    }

    /**
     * @return array
     */
    final public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param ProductInterface|null $item
     * @param AbstractBasket|null   $basket
     *
     * @return bool
     */
    public function isValid(ProductInterface $item = null, AbstractBasket $basket = null)
    {
        /** @var DecoratorInterface $decorator */
        foreach ($this->decorators as $decorator) {
            if (!$decorator->isValid($item, $basket)) {
                $this->errors[get_class($decorator)] = $decorator->getError();
            }
        }

        if (count($this->errors)) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return strtolower(str_replace('\\', '_', get_class($this)));
    }

}