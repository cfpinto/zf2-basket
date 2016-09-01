<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 09/08/2016
 * Time: 17:19
 */

namespace Zf2Basket\Product;


use Zf2Basket\Tax\TaxInterface;

interface ProductInterface extends \ArrayAccess, \Countable
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getBrand();

    /**
     * @return string
     */
    public function getCategory();

    /**
     * @return string
     */
    public function getVariant();

    /**
     * @return float
     */
    public function getPrice();

    /**
     * @return integer
     */
    public function getTaxRate();

    /**
     * @return float
     */
    public function getPriceTax();

    /**
     * @return float
     */
    public function getPriceNoTax();

    /**
     * @return TaxInterface
     */
    public function getTax();

    /**
     * @param TaxInterface $tax
     *
     * @return $this
     */
    public function setTax(TaxInterface $tax);

    /**
     * @return mixed
     */
    public function toJson();

    /**
     * @return mixed
     */
    public function toArray();

    /**
     * @return boolean
     */
    public function isTaxable();

    /**
     * @return boolean
     */
    public function hasOwnTax();
}