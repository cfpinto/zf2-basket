<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 16:28
 */

namespace Basket\Product;


abstract class AbstractProduct implements \ArrayAccess, \Countable
{
    const PROP_ID = 'id';
    const PROP_NAME = 'name';
    const PROP_BRAND = 'brand';
    const PROP_CATEGORY = 'category';
    const PROP_VARIANT = 'variant';
    const PROP_PRICE = 'price';
    const PROP_QUANTITY = 'quantity';
    const PROP_TAX_RATE = 'tax_rate';

    private $data = [
        self::PROP_ID => null,
        self::PROP_NAME => null,
        self::PROP_BRAND => null,
        self::PROP_CATEGORY => null,
        self::PROP_VARIANT => null,
        self::PROP_PRICE => null,
        self::PROP_QUANTITY => null,
        self::PROP_TAX_RATE => null,
    ];

    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }

    public function __set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    /**
     * Whether a offset exists
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @throws Exception
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    final public function offsetExists($offset)
    {
        if (!in_array($this->data[$offset])) {
            throw new Exception("Invalid offset {$offset} provided.");
        }
        return true;
    }

    /**
     * Offset to retrieve
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    final public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * Offset to set
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    final public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Offset to unset
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    final public function offsetUnset($offset)
    {
        $this->data[$offset] = null;
    }

    /**
     * Count elements of an object
     * @link  http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->data);
    }

    final public function toJson()
    {
        return json_encode($this->data);
    }

    final public function toArray()
    {
        return $this->data;
    }
}