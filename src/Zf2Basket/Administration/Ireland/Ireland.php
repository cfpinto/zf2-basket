<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 11:51
 */

namespace Zf2Basket\Administration\Ireland;


use Zf2Basket\Administration\AdministrationInterface;
use Zf2Basket\Currency\CurrencyInterface;
use Zf2Basket\Tax\TaxInterface;

class Ireland implements AdministrationInterface
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
        $this->currency = new Euro();
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