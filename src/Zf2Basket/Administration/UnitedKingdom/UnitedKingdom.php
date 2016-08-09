<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 11:51
 */

namespace Zf2Basket\Administration\UnitedKingdom;


use Zf2Basket\Administration\AdministrationInterface;
use Zf2Basket\Currency\AbstractCurrency;
use Zf2Basket\Tax\AbstractTax;

class UnitedKingdom implements AdministrationInterface
{

    protected $tax;

    protected $currency;

    function __construct()
    {
        $this->init();
    }


    function init()
    {
        $this->tax = new Vat();
        $this->currency = new Pound();
    }

    /**
     * @return AbstractTax
     */
    function getTax()
    {
        return $this->tax;
    }

    function setTax(AbstractTax $tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return AbstractCurrency
     */
    function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param AbstractCurrency $currency
     *
     * @return $this
     */
    function setCurrency(AbstractCurrency $currency)
    {
        $this->currency = $currency;
        return $this;
    }
}