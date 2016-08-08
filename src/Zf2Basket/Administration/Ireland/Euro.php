<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 14:16
 */

namespace Zf2Basket\Administration\Ireland;


use Zf2Basket\Currency\AbstractCurrency;

class Euro extends AbstractCurrency
{
    protected $name = 'Euro';

    protected $fractional = 'Cent';

    protected $decimalMark = '.';

    protected $thousandsMark = ',';

    protected $symbol = '€';

    protected $decimals = 2;
}