<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 11:50
 */

namespace Zf2Basket\Administration;


use Zf2Basket\Currency\AbstractCurrency;
use Zf2Basket\Tax\AbstractTax;

interface AdministrationInterface
{
    /**
     * @return AbstractTax
     */
    function getTax();

    /**
     * @param AbstractTax $tax
     *
     * @return $this
     */
    function setTax(AbstractTax $tax);

    /**
     * @return AbstractCurrency
     */
    function getCurrency();

    /**
     * @param AbstractCurrency $currency
     *
     * @return $this
     */
    function setCurrency(AbstractCurrency $currency);
}