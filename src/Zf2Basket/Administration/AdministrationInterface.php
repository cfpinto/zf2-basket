<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 11:50
 */

namespace Zf2Basket\Administration;


use Zf2Basket\Currency\CurrencyInterface;
use Zf2Basket\Tax\TaxInterface;

interface AdministrationInterface
{
    /**
     * @return TaxInterface
     */
    function getTax();

    /**
     * @param TaxInterface $tax
     *
     * @return $this
     */
    function setTax(TaxInterface $tax);

    /**
     * @return CurrencyInterface
     */
    function getCurrency();

    /**
     * @param CurrencyInterface $currency
     *
     * @return $this
     */
    function setCurrency(CurrencyInterface $currency);
}