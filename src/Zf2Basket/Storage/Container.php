<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 04/08/2016
 * Time: 11:31
 */

namespace Zf2Basket\Storage;


use Zf2Basket\Discount\DiscountInterface;
use Zf2Basket\Product\ProductInterface;

class Container implements \Serializable, \JsonSerializable
{
    const KEY_PRODUCT_ARRAY = 'product';
    const KEY_PRODUCT_OBJECT = 'object_object';
    const KEY_QUANTITY = 'quantity';

    /**
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    private $discounts = [];

    /**
     * @param $items
     *
     * @return $this
     */
    function setItems(array $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return array
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * @param $discounts
     *
     * @return $this
     */
    public function setDiscounts($discounts)
    {
        $this->discounts = $discounts;
        return $this;
    }

    /**
     * @param ProductInterface $product
     * @param int             $quantity
     *
     * @return $this
     */
    function increment(ProductInterface $product, $quantity = 1)
    {
        if (!isset($this->items[$product->getId()])) {
            $this->items[$product->getId()] = [
                self::KEY_PRODUCT_OBJECT => $product,
                self::KEY_QUANTITY => 0,
            ];
        }

        if ($this->items[$product->getId()][self::KEY_QUANTITY] + $quantity > 0) {
            $this->items[$product->getId()][self::KEY_QUANTITY] += $quantity;
        } else {
            unset($this->items[$product->getId()]);
        }
        return $this;
    }

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    function addDiscount(DiscountInterface $discount)
    {
        if (!isset($this->discounts[$discount->getId()])) {
            $this->discounts[$discount->getId()] = $discount;
        }

        return $this;

    }

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    function removeDiscount(DiscountInterface $discount)
    {
        if (!isset($this->discounts[$discount->getId()])) {
            unset($this->discounts[$discount->getId()]);
        }

        return $this;
    }

    function clear()
    {
        $this->items = [];
    }

    function toArray()
    {
        $items = [];
        foreach ($this->items as $key => $item) {
            /** @var ProductInterface $itemObject */
            $itemObject = $item[self::KEY_PRODUCT_OBJECT];
            $items[$key] = [
                self::KEY_PRODUCT_ARRAY => $itemObject->toArray(),
                self::KEY_QUANTITY => $item[self::KEY_QUANTITY],
            ];
        }

        return $items;
    }

    /**
     * @param ProductInterface|null $product
     *
     * @return int
     */
    function count(ProductInterface $product = null)
    {
        if (null === $product) {
            $count = 0;
            foreach ($this->items as $item) {
                $count += $item[self::KEY_QUANTITY];
            }

            return $count;
        }

        if (isset($this->items[$product->getId()])) {
            return $this->items[$product->getId()][self::KEY_QUANTITY];
        }

        return 0;
    }

    /**
     * String representation of object
     * @link  http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            'items' => $this->items,
            'discounts' => $this->discounts,
        ]);
    }

    /**
     * Constructs the object
     * @link  http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized <p>
     *                           The string representation of the object.
     *                           </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        $this->setItems($data['items']);
        $this->setDiscounts($data['discounts']);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return $this->toArray();
    }
}