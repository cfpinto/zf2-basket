<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 11:51
 */

namespace Zf2Basket\Administration\UnitedStates;


use Zf2Basket\Administration\AdministrationInterface;
use Zf2Basket\Currency\CurrencyInterface;
use Zf2Basket\Tax\TaxInterface;

class UnitedStates implements AdministrationInterface
{

    protected $tax;

    protected $currency;

    function __construct()
    {
        $this->init();
    }


    function init()
    {
        $this->currency = new Dollar();
    }

    /**
     * @return TaxInterface
     */
    function getTax()
    {
        return $this->tax;
    }

    function setTax(TaxInterface $tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return CurrencyInterface
     */
    function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param CurrencyInterface $currency
     *
     * @return $this
     */
    function setCurrency(CurrencyInterface $currency)
    {
        $this->currency = $currency;
        return $this;
    }
}