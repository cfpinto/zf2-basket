<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 04/08/2016
 * Time: 16:28
 */

namespace Zf2Basket\Product;


use Zf2Basket\Tax\TaxInterface;

/**
 * Class AbstractProduct
 *
 * @package Zf2Basket\Product
 * @property integer $id        ;
 * @property string  $name      ;
 * @property string  $brand     ;
 * @property string  $category  ;
 * @property string  $variant   ;
 * @property float   $price     ;
 * @property int     $taxRate   ;
 * @property float   $priceNoTax;
 * @property float   $priceTax  ;
 */
abstract class AbstractProduct implements ProductInterface
{
    const PROP_ID = 'id';
    const PROP_NAME = 'name';
    const PROP_BRAND = 'brand';
    const PROP_CATEGORY = 'category';
    const PROP_CATEGORY_ID = 'category_id';
    const PROP_VARIANT = 'variant';
    const PROP_PRICE = 'price';
    const PROP_TAX_RATE = 'taxRate';
    const PROP_PRICE_TAX = 'priceTax';
    const PROP_PRICE_NO_TAX = 'priceNoTax';

    private $data = [
        self::PROP_ID => null,
        self::PROP_NAME => null,
        self::PROP_BRAND => null,
        self::PROP_CATEGORY => null,
        self::PROP_CATEGORY_ID => null,
        self::PROP_VARIANT => null,
        self::PROP_PRICE => null,
        self::PROP_TAX_RATE => null,
        self::PROP_PRICE_TAX => null,
        self::PROP_PRICE_NO_TAX => null,
    ];

    /**
     * @var TaxInterface
     */
    private $tax;

    function getId()
    {
        return $this->offsetGet(self::PROP_ID);
    }

    function getName()
    {
        return $this->offsetGet(self::PROP_NAME);
    }

    function getBrand()
    {
        return $this->offsetGet(self::PROP_BRAND);
    }

    function getCategory()
    {
        return $this->offsetGet(self::PROP_CATEGORY);
    }

    function getCategoryId()
    {
        return $this->offsetGet(self::PROP_CATEGORY_ID);
    }

    function getVariant()
    {
        return $this->offsetGet(self::PROP_VARIANT);
    }

    function getPrice()
    {
        return $this->offsetGet(self::PROP_PRICE);
    }

    function getTaxRate()
    {
        return $this->offsetGet(self::PROP_TAX_RATE);
    }

    function getPriceTax()
    {
        return $this->offsetGet(self::PROP_PRICE_TAX);
    }

    function getPriceNoTax()
    {
        return $this->offsetGet(self::PROP_PRICE_NO_TAX);
    }

    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }

    public function __set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    /**
     * @return TaxInterface
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param TaxInterface $tax
     *
     * @return $this
     */
    public function setTax(TaxInterface $tax)
    {
        $this->tax = $tax;
        $this->data[self::PROP_TAX_RATE] = $tax->getRate();
        $this->data[self::PROP_PRICE_TAX] = round($this->data[self::PROP_PRICE] * $tax->getDecimal(), 2);
        $this->data[self::PROP_PRICE_NO_TAX] = $this->data[self::PROP_PRICE] - $this->data[self::PROP_PRICE_TAX];
        return $this;
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
        if (!array_key_exists($offset, $this->data)) {
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
        if (in_array($offset, array(self::PROP_PRICE, self::PROP_PRICE_NO_TAX, self::PROP_PRICE_TAX))) {
            return (float)$this->data[$offset];
        }
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
     * @throws Exception
     *
     * @return void
     * @since 5.0.0
     */
    final public function offsetSet($offset, $value)
    {
        if (in_array($offset, [self::PROP_TAX_RATE, self::PROP_PRICE_NO_TAX, self::PROP_PRICE_TAX])) {
            throw new Exception("Invalid property type {$offset}, use method addTax(Tax \$tax) to dynamically calculate tax values");
        }

        if (in_array($offset, [self::PROP_PRICE])) {
            $value = (float)$value;
        }

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
    final public function count()
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

    /**
     * @return boolean
     */
    abstract public function isTaxable();

    /**
     * @return boolean
     */
    abstract public function hasOwnTax();
}