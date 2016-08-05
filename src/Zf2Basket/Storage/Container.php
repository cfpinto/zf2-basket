<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 11:31
 */

namespace Zf2Basket\Storage;


use Zf2Basket\Product\AbstractProduct;

class Container implements \Serializable, \JsonSerializable
{
    const KEY_PRODUCT = 'product';
    const KEY_QUANTITY = 'quantity';

    /**
     * @var array
     */
    private $items = [];

    /**
     * @param $items
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
     * @param AbstractProduct $product
     * @param int $quantity
     * @return $this
     */
    function increment(AbstractProduct $product, $quantity = 1)
    {
        if (!isset($this->items[$product->getId()])) {
            $this->items[$product->getId()] = [
                self::KEY_PRODUCT => $product->toArray(),
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

    function clear()
    {
        $this->items = [];
    }

    /**
     * @param AbstractProduct|null $product
     * @return int
     */
    function count(AbstractProduct $product = null)
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
        return serialize($this->items);
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
        $this->items = unserialize($serialized);
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
        return $this->items;
    }
}