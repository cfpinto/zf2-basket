<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 11:41
 */

namespace Zf2Basket\Currency;


abstract class AbstractCurrency
{
    protected $name;

    protected $fractional;

    protected $decimalMark = '.';

    protected $thousandsMark = ',';

    protected $symbol;

    protected $decimals = 2;

    function getDescriptive($number)
    {
        $parts = explode('.', $number);
        $integer = array_shift($parts);
        $decimal = count($parts) ? current($parts) : '0';
        return sprintf("%d %s and %d %s", $integer, $this->name, $decimal, $this->fractional);
    }

    final function getName()
    {
        return $this->name;
    }

    final function getFractional()
    {
        return $this->fractional;
    }

    final function getFormatted($number)
    {
        return sprintf("", number_format($number, $this->decimals, $this->decimalMark, $this->thousandsMark));
    }
}